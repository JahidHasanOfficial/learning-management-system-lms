<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Gradebook;
use Illuminate\Support\Facades\Storage;

class AssessmentService
{
    /**
     * Store quiz submission and calculate score.
     */
    public function submitQuiz($userId, $quizId, array $answers)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        $totalMarks = $quiz->questions->sum('marks');
        $earnedScore = 0;

        foreach ($quiz->questions as $question) {
            $studentAnswer = $answers[$question->id] ?? null;
            if ($studentAnswer == $question->correct_answer) {
                $earnedScore += $question->marks;
            }
        }

        $passPercentage = $quiz->pass_percentage;
        $earnedPercentage = ($earnedScore / $totalMarks) * 100;
        $status = $earnedPercentage >= $passPercentage ? 'passed' : 'failed';

        return QuizSubmission::create([
            'user_id' => $userId,
            'quiz_id' => $quizId,
            'score' => $earnedScore,
            'total_marks' => $totalMarks,
            'answers' => $answers,
            'status' => $status
        ]);
    }

    /**
     * Submit an assignment.
     */
    public function submitAssignment($userId, $assignmentId, $file)
    {
        $path = $file->store('submissions/assignments', 'public');

        return AssignmentSubmission::create([
            'user_id' => $userId,
            'assignment_id' => $assignmentId,
            'file_path' => $path,
            'status' => 'submitted'
        ]);
    }

    /**
     * Grade an assignment.
     */
    public function gradeAssignment($submissionId, $marks, $feedback)
    {
        $submission = AssignmentSubmission::findOrFail($submissionId);
        $submission->update([
            'marks_awarded' => $marks,
            'feedback' => $feedback,
            'status' => 'graded'
        ]);

        return $submission;
    }
}
