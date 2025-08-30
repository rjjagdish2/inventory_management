<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::insert([
            [
                'name' => 'customer 1',
                'phone' => '1324567891',
            ],
            [
                'name' => 'customer 2',
                'phone' => '1324567892',
            ],
            [
                'name' => 'customer 3',
                'phone' => '1324567892',
            ],
            [
                'name' => 'customer 4',
                'phone' => '1324567894',
            ],
            [
                'name' => 'customer 5',
                'phone' => '1324567895',
            ],
            [
                'name' => 'customer 6',
                'phone' => '1324567896',
            ],
        ]);
    }
}
