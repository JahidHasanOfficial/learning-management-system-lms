<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['video', 'pdf', 'text', 'quiz', 'assignment'])->default('text');
            $table->text('content')->nullable(); // For text lessons
            $table->string('file_path')->nullable(); // For PDF or assignments
            $table->string('video_url')->nullable();
            $table->string('video_provider')->nullable(); // youtube, vimeo, html5
            $table->string('video_duration')->nullable();
            $table->boolean('is_preview')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
