<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Metal;

class AddGrades extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Metal::insert([
            'id'=>1,
            'name' => 'Brass',
        ]);
        Grade::insert([
            [
                'metal_id'=>1,
                'name' => 'A',
            ],
            [
                'metal_id'=>1,
                'name' => 'B',
            ],

        ]);
    }
}
