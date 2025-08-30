<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class AddGrades extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::insert([
            [
                'name' => 'A',
            ],
            [
                'name' => 'B',
            ],
            [
                'name' => 'C',
            ],
            [
                'name' => 'D',
            ],
            [
                'name' => 'E',
            ],
            [
                'name' => 'F',
            ],
        ]);
    }
}
