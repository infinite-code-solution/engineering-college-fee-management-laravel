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
        // Mock JNTU Affiliated Institution
        $college = College::create([
            'code' => 'A5',
            'name' => 'Aditya Institute of Technology and Management',
            'location' => 'Tekkali, Andhra Pradesh'
        ]);

        $cse = Course::create([
            'college_id' => $college->id,
            'name' => 'B.Tech Computer Science Engineering',
            'branch_code' => 'CSE'
        ]);

        // Official JNTU AFRC regulated fee mapping structures
        FeeStructure::create([
            'course_id' => $cse->id,
            'academic_year' => 2026,
            'tuition_fee' => 43000.00,
            'jntu_common_service_fee' => 1850.00,
            'exam_fee' => 1200.00,
            'library_fee' => 500.00,
        ]);

        // Admin User Generation
        User::create([
            'name' => 'JNTU Admin Desk',
            'email' => 'admin@jntu.edu.in',
            'password' => Hash::make('Admin@123'),
            'role' => 'admin',
            'college_id' => $college->id
        ]);

        // Student Identity Generation
        $studentUser = User::create([
            'name' => 'Suresh Kumar',
            'email' => 'suresh@jntu.edu.in',
            'password' => Hash::make('Student@123'),
            'role' => 'student',
            'college_id' => $college->id
        ]);

        $student = Student::create([
            'user_id' => $studentUser->id,
            'course_id' => $cse->id,
            'admission_number' => '23A51A0501', // Standard JNTU formatting
            'current_year' => 3,
            'current_semester' => 1
        ]);

        // Seed initial history
        Payment::create([
            'student_id' => $student->id,
            'transaction_id' => 'JNTUMOCK10293',
            'amount_paid' => 20000.00,
            'payment_mode' => 'Challan',
            'remarks' => 'Partial Advanced Tuition Remittance'
        ]);
    }
}
