<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customers;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Customers::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'admin@teammjay.com',
            'password' => ('P@ssw0rd99999'),
            'is_admin' => 1
        ]);
    }
}
