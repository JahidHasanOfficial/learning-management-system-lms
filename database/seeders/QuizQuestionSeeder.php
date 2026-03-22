<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\QuizQuestion;

class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = Quiz::all();
        if ($quizzes->isEmpty()) return;

        foreach ($quizzes as $quiz) {
            // MCQ Question
            QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question_text' => 'What is the primary goal of this course?',
                'type' => 'mcq',
                'options' => [
                    'Learning new skills',
                    'Getting a certificate only',
                    'Wasting time',
                    'None of the above'
                ],
                'correct_answer' => 'Learning new skills',
                'marks' => 2,
            ]);

            // True/False Question
            QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question_text' => 'Is this a beginner friendly course?',
                'type' => 'true_false',
                'options' => ['True', 'False'],
                'correct_answer' => 'True',
                'marks' => 1,
            ]);

            // Fill blanks
            QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question_text' => 'The _____ approach is used here.',
                'type' => 'fill_blanks',
                'options' => null,
                'correct_answer' => 'practical',
                'marks' => 3,
            ]);
        }
    }
}
