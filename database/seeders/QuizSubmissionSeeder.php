<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuizSubmission;
use App\Models\Quiz;
use App\Models\User;

class QuizSubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = Quiz::take(3)->get();
        $students = User::role('student')->get();
        if ($students->isEmpty()) {
            $students = User::take(3)->get();
        }

        foreach ($quizzes as $quiz) {
            foreach ($students as $student) {
                QuizSubmission::create([
                    'quiz_id' => $quiz->id,
                    'user_id' => $student->id,
                    'score' => rand(60, 100),
                    'total_marks' => 100,
                    'answers' => ['q1' => 'a', 'q2' => 'b'],
                    'status' => 'passed',
                ]);
            }
        }
    }
}
