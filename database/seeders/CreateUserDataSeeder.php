<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Seeder;

class CreateUserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create customer using facker
        foreach (range(1, 10) as $index) {
            Customers::factory()->create();
        }

    }
}
