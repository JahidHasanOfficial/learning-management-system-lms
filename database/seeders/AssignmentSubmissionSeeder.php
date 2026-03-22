<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssignmentSubmission;
use App\Models\Assignment;
use App\Models\User;

class AssignmentSubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $assignments = Assignment::take(3)->get();
        $students = User::role('student')->get();
        if ($students->isEmpty()) {
            $students = User::take(3)->get();
        }

        foreach ($assignments as $assignment) {
            foreach ($students as $student) {
                AssignmentSubmission::create([
                    'assignment_id' => $assignment->id,
                    'user_id' => $student->id,
                    'file_path' => 'submissions/assignment_' . $assignment->id . '_user_' . $student->id . '.pdf',
                    'marks_obtained' => rand(5, 10),
                    'feedback' => 'Good effort! Keep practicing.',
                    'status' => 'graded',
                ]);
            }
        }
    }
}
