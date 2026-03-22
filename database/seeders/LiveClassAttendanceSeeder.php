<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LiveClassAttendance;
use App\Models\LiveClass;
use App\Models\User;

class LiveClassAttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $liveClasses = LiveClass::all();
        $students = User::role('student')->get();
        if ($students->isEmpty()) {
            $students = User::take(5)->get();
        }

        foreach ($liveClasses as $liveClass) {
            foreach ($students as $student) {
                LiveClassAttendance::create([
                    'user_id' => $student->id,
                    'live_class_id' => $liveClass->id,
                    'joined_at' => $liveClass->start_time,
                    'left_at' => $liveClass->start_time->addMinutes(45),
                    'duration_stayed' => 45,
                    'is_present' => true,
                ]);
            }
        }
    }
}
