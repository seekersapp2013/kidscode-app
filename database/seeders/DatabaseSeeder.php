<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\DataRowsTableSeeder;
use Database\Seeders\DataTypesTableSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\MenuItemsTableSeeder;
use Database\Seeders\MenusTableSeeder;
use Database\Seeders\PagesTableSeeder;
use Database\Seeders\PermissionRoleTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\PostsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use Database\Seeders\TranslationsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\VoyagerDatabaseSeeder;
use Database\Seeders\VoyagerDummyDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            MenusTableSeeder::class,
            MenuItemsTableSeeder::class,
            CategoriesTableSeeder::class,
            DataTypesTableSeeder::class,
            DataRowsTableSeeder::class,
            PagesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            PostsTableSeeder::class,
            SettingsTableSeeder::class,
            TranslationsTableSeeder::class,
            VoyagerDatabaseSeeder::class,
            VoyagerDummyDatabaseSeeder::class
        ]);
    }
}
