<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    public function run(): void
    {
        $colleges = [
            [
                'college_name' => 'Tech University of Science',
                'college_code' => 'TUS101',
                'college_email' => 'info@tus.edu',
                'college_mobile' => '+1234567890',
                'college_website' => 'https://tus.edu',
                'college_address' => '123 Innovation Way, Tech City',
            ],
            [
                'college_name' => 'National Institute of Arts',
                'college_code' => 'NIA202',
                'college_email' => 'admissions@nia.edu',
                'college_mobile' => '+1987654321',
                'college_website' => 'https://nia.edu',
                'college_address' => '456 Creative Boulevard, Arts District',
            ]
        ];

        foreach ($colleges as $college) {
            College::firstOrCreate(
                ['college_code' => $college['college_code']],
                [
                    'college_name' => $college['college_name'],
                    'college_email' => $college['college_email'],
                    'college_mobile' => $college['college_mobile'],
                    'college_website' => $college['college_website'],
                    'college_address' => $college['college_address'],
                ]
            );
        }
    }
}
