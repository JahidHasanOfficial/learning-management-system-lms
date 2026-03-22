<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LiveClassChat;
use App\Models\LiveClass;
use App\Models\User;

class LiveClassChatSeeder extends Seeder
{
    public function run(): void
    {
        $liveClasses = LiveClass::all();
        $students = User::take(3)->get();
        $instructor = User::role('instructor')->first();

        foreach ($liveClasses as $liveClass) {
            foreach ($students as $student) {
                LiveClassChat::create([
                    'user_id' => $student->id,
                    'live_class_id' => $liveClass->id,
                    'message' => 'Hello everyone! Excited for ' . $liveClass->title,
                    'is_instructor' => false,
                ]);
            }

            if ($instructor) {
                LiveClassChat::create([
                    'user_id' => $instructor->id,
                    'live_class_id' => $liveClass->id,
                    'message' => 'Welcome students! Let\'s begin our session on ' . $liveClass->title,
                    'is_instructor' => true,
                ]);
            }
        }
    }
}
