<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('academic_years')->insert([
            ['academic_year_name' => '2024-2025', 'created_at' => now(), 'updated_at' => now()],
            ['academic_year_name' => '2025-2026', 'created_at' => now(), 'updated_at' => now()],
            ['academic_year_name' => '2026-2027', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
