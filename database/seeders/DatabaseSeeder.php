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
         // import the customer seeder
            $this->call(CreateUserDataSeeder::class);
    }
}
