<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Supervisor;
use App\Models\ProductProfile;

class supplierProductSupervisor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Supplier::insert([
            [
                'name' => 'supplier1',
                'phone' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supplier2',
                'phone' => '9874561230',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supplier3',
                'phone' => '9876543215',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supplier4',
                'phone' => '7412589632',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supplier5',
                'phone' => '6478963252',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Supervisor::insert([
            [
                'name' => 'supervisor1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supervisor2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supervisor3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supervisor4',                
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supervisor5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        ProductProfile::insert([
            [
                'name'=>"product1",
                'item_code'=>"a123",
                'size'=>12.12,
                'grade'=>1,
                'castig_ratio'=>'1:2',
                'design'=>'',
                'qty'=>'100',
                'created_at' => now(),
                'updated_at' => now(),
        
            ],
            [
                'name'=>"product2",
                'item_code'=>"b123",
                'size'=>23.23,
                'grade'=>5,
                'castig_ratio'=>'1:5',
                'design'=>'',
                'qty'=>'50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>"product3",
                'item_code'=>"c123",
                'size'=>56.56,
                'grade'=>4,
                'castig_ratio'=>'2:5',
                'design'=>'',
                'qty'=>'150',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>"product4",
                'item_code'=>"d123",
                'size'=>23.23,
                'grade'=>2,
                'castig_ratio'=>'3:5',
                'design'=>'',
                'qty'=>'100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>"product5",
                'item_code'=>"e123",
                'size'=>13.83,
                'grade'=>3,
                'castig_ratio'=>'3:5',
                'design'=>'',
                'qty'=>'100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
   
    }
}
