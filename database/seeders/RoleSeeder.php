<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $spv = Role::create(['name' => 'spv']);
        $manager = Role::create(['name' => 'manager']);
        Role::create(['name' => 'kalibrasi']);
        Role::create(['name' => 'kualifikasi']);
        Role::create(['name' => 'mapping']);

        // Create permissions for admin
        $permissions = [
            'view_user', 'create_user', 'edit_user', 'delete_user',
            'view_role', 'create_role', 'edit_role', 'delete_role',
            'view_master_calibration', 'create_master_calibration', 'edit_master_calibration', 'delete_master_calibration',
            'view_master_qualification', 'create_master_qualification', 'edit_master_qualification', 'delete_master_qualification',
            'view_master_mapping', 'create_master_mapping', 'edit_master_mapping', 'delete_master_mapping',
            'view_program_calibration', 'create_program_calibration', 'edit_program_calibration', 'delete_program_calibration',
            'view_program_qualification', 'create_program_qualification', 'edit_program_qualification', 'delete_program_qualification',
            'view_program_mapping', 'create_program_mapping', 'edit_program_mapping', 'delete_program_mapping',
            'view_execution_calibration', 'create_execution_calibration', 'edit_execution_calibration', 'delete_execution_calibration',
            'view_execution_qualification', 'create_execution_qualification', 'edit_execution_qualification', 'delete_execution_qualification',
            'view_execution_mapping', 'create_execution_mapping', 'edit_execution_mapping', 'delete_execution_mapping',
            'approve_program', 'approve_execution',
            'view_company_branding', 'edit_company_branding',
            'view_system_setting', 'edit_system_setting',
            'view_custom_field', 'create_custom_field', 'edit_custom_field', 'delete_custom_field',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign all permissions to admin
        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo([
            'approve_program', 'approve_execution',
            'view_master_calibration', 'create_master_calibration', 'edit_master_calibration',
            'view_master_qualification', 'create_master_qualification', 'edit_master_qualification',
            'view_master_mapping', 'create_master_mapping', 'edit_master_mapping',
            'view_program_calibration', 'create_program_calibration', 'edit_program_calibration',
            'view_program_qualification', 'create_program_qualification', 'edit_program_qualification',
            'view_program_mapping', 'create_program_mapping', 'edit_program_mapping',
            'view_execution_calibration', 'create_execution_calibration', 'edit_execution_calibration',
            'view_execution_qualification', 'create_execution_qualification', 'edit_execution_qualification',
            'view_execution_mapping', 'create_execution_mapping', 'edit_execution_mapping',
        ]);
    }
}
