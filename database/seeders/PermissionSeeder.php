<?php
namespace Database\Seeders;

use App\Models\ModuleList;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Generate desired permissions list
        $permissions = [];

        // Module-based permissions
        $modules = ModuleList::pluck('name')->unique()->values();

        foreach ($modules as $module) {
            $permissions[] = "access $module";
            $permissions[] = "create $module";
            $permissions[] = "edit $module";
            $permissions[] = "view $module";
            $permissions[] = "delete $module";
        }

        // Static permissions
        $staticPermissions = [
            'access setting',
            'access site-setting',
            'access donation-polices',
            'access google-api',
            'access invitation-hours',
        ];

        $permissions = array_merge($permissions, $staticPermissions);

        // Existing permissions from DB
        $existingPermissions = Permission::pluck('name')->toArray();

        // Permissions to add
        $toAdd = array_diff($permissions, $existingPermissions);
        foreach ($toAdd as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Permissions to delete
        $toDelete = array_diff($existingPermissions, $permissions);
        Permission::whereIn('name', $toDelete)->delete();

        // Assign all permissions to admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());
    }
}
