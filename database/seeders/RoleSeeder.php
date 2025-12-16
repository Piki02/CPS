<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $roleSupplier = Role::create(['name' => 'Supplier']);
        $roleBranch = Role::create(['name' => 'Branch Store']);
        $roleAdmin = Role::create(['name' => 'Admin']);

        // Create Permissions (Optional for now, but good practice)
        // Permission::create(['name' => 'edit articles']);

        // Assign Permissions to Roles (if any)
        // $roleSupplier->givePermissionTo('edit articles');
    }
}
