<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\supplierProductSupervisor;
use Database\Seeders\AddGrades;
use Database\Seeders\ProdctSupplierSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234')
        ]);
        $this->call(AddGrades::class);
        $this->call(supplierProductSupervisor::class);
        $this->call(ProdctSupplierSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CategorySeeder::class);
        
    }
}
