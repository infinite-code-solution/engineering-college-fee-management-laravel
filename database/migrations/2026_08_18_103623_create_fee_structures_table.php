<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->string('fee_structure_name')->unique();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->integer('academic_year'); 
            $table->decimal('tuition_fee', 10, 2);
            $table->decimal('jntu_common_service_fee', 10, 2); // Regulatory University Fee
            $table->decimal('exam_fee', 10, 2);
            $table->decimal('library_fee', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('fee_structures');
    }
};
