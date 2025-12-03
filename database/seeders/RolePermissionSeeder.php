<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'add-program']);
        Permission::create(['name' => 'update-program']);
        Permission::create(['name' => 'delete-program']);
        Permission::create(['name' => 'show-program']);

        Permission::create(['name' => 'add-programDetail']);
        Permission::create(['name' => 'update-programDetail']);
        Permission::create(['name' => 'delete-programDetail']);
        Permission::create(['name' => 'show-programDetail']);

        Permission::create(['name' => 'add-banner']);
        Permission::create(['name' => 'update-banner']);
        Permission::create(['name' => 'delete-banner']);
        Permission::create(['name' => 'show-banner']);

        Permission::create(['name' => 'add-facility']);
        Permission::create(['name' => 'update-facility']);
        Permission::create(['name' => 'delete-facility']);
        Permission::create(['name' => 'show-facility']);

        Permission::create(['name' => 'add-admission']);
        Permission::create(['name' => 'update-admission']);
        Permission::create(['name' => 'delete-admission']);
        Permission::create(['name' => 'show-admission']);

        Permission::create(['name' => 'add-event']);
        Permission::create(['name' => 'update-event']);
        Permission::create(['name' => 'delete-event']);
        Permission::create(['name' => 'show-event']);

        Permission::create(['name' => 'add-eventNews']);
        Permission::create(['name' => 'update-eventNews']);
        Permission::create(['name' => 'delete-eventNews']);
        Permission::create(['name' => 'show-eventNews']);

        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

        Role::create(['name' => 'marketing'])->givePermissionTo([
            'add-banner',
            'update-banner',
            'delete-banner',
            'add-admission',
            'update-admission',
            'delete-admission',
            'show-program',
            'show-programDetail',
            'show-banner',
            'show-facility',
            'show-admission',
            'show-event',
            'show-eventNews',
        ]);

        Role::create(['name' => 'public_relations'])->givePermissionTo([
            'add-event',
            'update-event',
            'delete-event',
            'add-eventNews',
            'update-eventNews',
            'delete-eventNews',
            'show-program',
            'show-programDetail',
            'show-banner',
            'show-facility',
            'show-admission',
            'show-event',
            'show-eventNews',
        ]);

        Role::create(['name' => 'finance'])->givePermissionTo([
            'add-admission',
            'update-admission',
            'delete-admission',
            'show-program',
            'show-programDetail',
            'show-banner',
            'show-facility',
            'show-admission',
            'show-event',
            'show-eventNews',
        ]);

        Role::create(['name' => 'lecturer'])->givePermissionTo([
            'add-program',
            'update-program',
            'delete-program',
            'add-programDetail',
            'update-programDetail',
            'delete-programDetail',
            'show-program',
            'show-programDetail',
            'show-banner',
            'show-facility',
            'show-admission',
            'show-event',
            'show-eventNews',
        ]);
    }
}
