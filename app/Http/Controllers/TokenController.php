<?php

namespace App\Http\Controllers;

use App\Models\StoreToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function showForm()
    {
        return view('auth.token');
    }

    public function index()
    {
        $tokens = StoreToken::latest()->get();
        return view('tokens.index', compact('tokens'));
    }

    public function validateToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $token = StoreToken::where('token', $request->token)
            ->where('is_active', true)
            ->first();

        if (!$token) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        // Check expiration if set
        if ($token->expires_at && $token->expires_at->isPast()) {
            return back()->withErrors(['token' => 'Token has expired.']);
        }

        // Store in session with captain name and vessel name
        session(['store_access_token' => $token->token]);
        session(['captain_name' => $token->captain_name]);
        session(['vessel_name' => $token->vessel_name]);

        return redirect()->route('store');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'captain_name' => 'required|string|max:255',
            'vessel_name' => 'nullable|string|max:255',
        ]);

        $token = StoreToken::create([
            'token' => Str::upper(Str::random(8)),
            'captain_name' => $request->captain_name,
            'vessel_name' => $request->vessel_name,
            'created_by' => auth()->id(),
            'expires_at' => null, // No expiration - valid until checkout
        ]);

        return back()->with('success', 'Token generated: ' . $token->token . ' - Captain: ' . $token->captain_name . ' - Vessel: ' . ($token->vessel_name ?? 'N/A') . ' (Valid until checkout)');
    }
}
