<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConsultationSlot;
use App\Models\User;

class ConsultationSlotSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = User::role('instructor')->get();
        if ($instructors->isEmpty()) {
            $instructors = User::take(3)->get();
        }

        foreach ($instructors as $instructor) {
            ConsultationSlot::create([
                'mentor_id' => $instructor->id,
                'user_id' => null, // Available
                'start_time' => now()->addDays(2)->setHour(10)->setMinute(0),
                'end_time' => now()->addDays(2)->setHour(11)->setMinute(0),
                'status' => 'available',
                'meeting_link' => null,
            ]);

            ConsultationSlot::create([
                'mentor_id' => $instructor->id,
                'user_id' => null, // Available
                'start_time' => now()->addDays(3)->setHour(14)->setMinute(0),
                'end_time' => now()->addDays(3)->setHour(15)->setMinute(0),
                'status' => 'available',
                'meeting_link' => null,
            ]);
        }
    }
}
