<?php

namespace Database\Factories;

use App\Models\FeeStructure;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeeStructureFactory extends Factory
{
    protected $model = FeeStructure::class;

    public function definition(): array
    {
        // Enforce standardized fee structures
        $totalAmount = $this->faker->randomElement([1200, 2500, 3500, 5000]);
        
        // Randomize whether a student paid all, some, or none of their balance
        $paymentType = $this->faker->randomElement(['full', 'partial', 'none']);
        
        $amountPaid = match($paymentType) {
            'full' => $totalAmount,
            'partial' => $this->faker->randomFloat(2, 200, $totalAmount - 100),
            'none' => 0.00,
        };

        return [
            'student_name' => $this->faker->name(),
            'roll_number'  => 'STU' . $this->faker->unique()->numberBetween(10000, 99999),
            'fee_type'     => $this->faker->randomElement(['Tuition', 'Transport', 'Examination', 'Library']),
            'total_amount' => $totalAmount,
            'amount_paid'  => $amountPaid,
            // 'balance_amount' and 'status' are automatically computed by your Model boot method!
            'due_date'     => $this->faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
        ];
    }
}
