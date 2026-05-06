<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        $permissions = [
    'view products',
    'create products',
    'edit products',
    'delete products',
    'buy products',
    'cancel order',
    'manage users',
];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $client = Role::firstOrCreate(['name' => 'client']);
        $guest = Role::firstOrCreate(['name' => 'guest']);

        $admin->syncPermissions(Permission::all());

        $manager->syncPermissions([
    'view products','create products','edit products','delete products'
]);

$client->syncPermissions([
    'view products','buy products','cancel order'
]);

$guest->syncPermissions(['view products']);

        // USERS
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@mail.com'],
            ['name' => 'Admin','password' => bcrypt('123456')]
        );
        $adminUser->assignRole('admin');

        $managerUser = User::firstOrCreate(
            ['email' => 'manager@mail.com'],
            ['name' => 'Manager','password' => bcrypt('123456')]
        );
        $managerUser->assignRole('manager');

        $clientUser = User::firstOrCreate(
            ['email' => 'client@mail.com'],
            ['name' => 'Client','password' => bcrypt('123456')]
        );
        $clientUser->assignRole('client');
    }
}