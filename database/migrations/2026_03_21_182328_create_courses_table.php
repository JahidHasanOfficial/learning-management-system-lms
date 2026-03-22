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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->string('thumbnail')->nullable();
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('career_path')->nullable(); 
            $table->enum('status', ['draft', 'published', 'pending_approval', 'rejected'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->json('tags')->nullable();
            $table->timestamps();
        });

        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('progress')->default(0); 
            $table->enum('status', ['enrolled', 'ongoing', 'completed'])->default('enrolled');
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_user');
        Schema::dropIfExists('courses');
    }
};
