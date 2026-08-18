<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Payment;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeeController extends Controller {
    // Admin Only: Fee master summary dashboard
    public function index(Request $request) {
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized Access Level'], 403);
        }

        return response()->json(Student::with(['user', 'course'])->get());
    }

    // Student or Admin: Detailed breakdown statement
    public function show(Request $request, $id) {
        $student = Student::with(['user', 'course', 'payments'])->find($id);

        if (!$student) return response()->json(['error' => 'Student record not found'], 404);

        // Limit students to only access their own records
        if ($request->user()->role === 'student' && $request->user()->id !== $student->user_id) {
            return response()->json(['error' => 'Unauthorized Access Level'], 403);
        }

        return response()->json([
            'student' => $student,
            'breakdown' => FeeStructure::where('course_id', $student->course_id)->first()
        ]);
    }

    // Dynamic processing engine for fee collection
    public function pay(Request $request) {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount_paid' => 'required|numeric|min:1',
            'payment_mode' => 'required|string'
        ]);

        $student = Student::find($request->student_id);

        if ($request->user()->role === 'student' && $request->user()->id !== $student->user_id) {
            return response()->json(['error' => 'Unauthorized payment attempt'], 403);
        }

        if ($request->amount_paid > $student->due_fee) {
            return response()->json(['error' => 'Payment exceeds outstanding balance of ' . $student->due_fee], 422);
        }

        $payment = Payment::create([
            'student_id' => $student->id,
            'transaction_id' => 'JNTU' . Str::upper(Str::random(10)),
            'amount_paid' => $request->amount_paid,
            'payment_mode' => $request->payment_mode,
            'remarks' => $request->remarks ?? 'Academic Fee Clearance'
        ]);

        return response()->json([
            'message' => 'Transaction settled successfully',
            'receipt' => $payment,
            'remaining_dues' => $student->fresh()->due_fee
        ]);
    }
}
