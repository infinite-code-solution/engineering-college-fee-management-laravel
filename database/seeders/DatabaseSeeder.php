<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\College;
use App\Models\Course;
use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            CollegeSeeder::class,
        ]);

        // Mock JNTU Affiliated Institution
        $college = College::firstOrCreate(
            ['college_code' => 'A5'],
            [
                'college_name' => 'Aditya Institute of Technology and Management',
                'college_email' => 'admin@aditya.edu',
                'college_mobile' => '9998887776',
                'college_address' => 'Tekkali, Andhra Pradesh'
            ]
        );

        $cse = Course::firstOrCreate(
            ['branch_code' => 'CSE', 'college_id' => $college->id],
            ['name' => 'B.Tech Computer Science Engineering']
        );

        // Official JNTU AFRC regulated fee mapping structures
        FeeStructure::firstOrCreate(
            ['course_id' => $cse->id, 'academic_year' => 2026],
            [
                'tuition_fee' => 43000.00,
                'jntu_common_service_fee' => 1850.00,
                'exam_fee' => 1200.00,
                'library_fee' => 500.00,
            ]
        );

        // Admin User Generation
        User::firstOrCreate(
            ['email' => 'admin@jntu.edu.in'],
            [
                'name' => 'JNTU Admin Desk',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'college_id' => $college->id
            ]
        );

        // Student Identity Generation
        $studentUser = User::firstOrCreate(
            ['email' => 'suresh@jntu.edu.in'],
            [
                'name' => 'Suresh Kumar',
                'password' => Hash::make('Student@123'),
                'role' => 'student',
                'college_id' => $college->id
            ]
        );

        $student = Student::firstOrCreate(
            ['user_id' => $studentUser->id, 'admission_number' => '23A51A0501'], // Standard JNTU formatting
            [
                'course_id' => $cse->id,
                'current_year' => 3,
                'current_semester' => 1
            ]
        );

        // Seed initial history
        Payment::firstOrCreate(
            ['transaction_id' => 'JNTUMOCK10293'],
            [
                'student_id' => $student->id,
                'amount_paid' => 20000.00,
                'payment_mode' => 'Challan',
                'remarks' => 'Partial Advanced Tuition Remittance'
            ]
        );
    }
}
