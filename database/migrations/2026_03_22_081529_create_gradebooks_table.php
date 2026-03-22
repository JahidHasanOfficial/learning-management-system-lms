<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gradebooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->decimal('quiz_score', 8, 2)->default(0);
            $table->decimal('assignment_score', 8, 2)->default(0);
            $table->decimal('total_score', 8, 2)->default(0);
            $table->string('grade')->nullable();
            $table->enum('status', ['pass', 'fail'])->default('fail');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gradebooks');
    }
};
