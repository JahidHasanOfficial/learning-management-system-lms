<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MentorAssignment;
use App\Models\User;
use App\Models\Batch;

class MentorAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $mentors = User::role('instructor')->get();
        $batches = Batch::all();
        $students = User::role('student')->get();

        foreach ($batches as $batch) {
            $mentor = $mentors->random() ?? User::find(1);
            if ($mentor && $students->isNotEmpty()) {
                MentorAssignment::create([
                    'mentor_id' => $mentor->id,
                    'user_id' => $students->random()->id,
                    'batch_id' => $batch->id,
                    'status' => 'active',
                ]);
            }
        }
    }
}
