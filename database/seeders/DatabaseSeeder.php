<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Electro;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // CALL ROLE SEEDER
        $this->call(RolePermissionSeeder::class);

        // TEST DATA
        Electro::factory(10)->create();
    }
}