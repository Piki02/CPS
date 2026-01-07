<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromView, ShouldAutoSize, WithStyles, \Maatwebsite\Excel\Concerns\WithDrawings
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function view(): View
    {
        return view('exports.order', [
            'order' => $this->order
        ]);
    }

    public function drawings()
    {
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('CPS Logo');
        $drawing->setPath(public_path('Img/Logo sin Fondo.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return [$drawing];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // No specific row styles needed here as most are handled in Blade, 
            // but we can ensure default alignment if needed.
            // 7 is the header separator line
        ];
    }
}
