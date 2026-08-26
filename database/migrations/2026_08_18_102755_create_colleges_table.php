<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colleges', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('college_name');
            $blueprint->string('college_code')->unique();
            $blueprint->string('college_email')->unique();
            $blueprint->string('college_mobile', 20);
            $blueprint->string('college_website')->nullable();
            $blueprint->text('college_address')->nullable();
            $blueprint->softDeletes(); // Adds deleted_at column for soft deletes
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
