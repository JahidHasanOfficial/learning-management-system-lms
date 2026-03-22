<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = User::role('Instructor')->get();
        if ($instructors->isEmpty()) return;

        $categories = Category::all();
        if ($categories->isEmpty()) return;

        $courses = [
            ['title' => 'Full Stack Laravel Mastery', 'price' => 49.99, 'career_path' => 'Web Development'],
            ['title' => 'Flutter Mobile Apps Course', 'price' => 39.99, 'career_path' => 'Mobile App Development'],
            ['title' => 'UI/UX Design Essentials', 'price' => 29.99, 'career_path' => 'Graphics Design'],
            ['title' => 'Digital Marketing Strategy', 'price' => 19.99, 'career_path' => 'Marketing'],
            ['title' => 'Business Analytics with Excel', 'price' => 24.99, 'career_path' => 'Business'],
            ['title' => 'Python for Data Science', 'price' => 59.99, 'career_path' => 'Data Science'],
            ['title' => 'React Native with Expo', 'price' => 44.99, 'career_path' => 'Mobile App Development'],
            ['title' => 'Mastering Adobe Illustrator', 'price' => 25.00, 'career_path' => 'Graphics Design'],
            ['title' => 'SEO and Content Writing', 'price' => 15.00, 'career_path' => 'Marketing'],
            ['title' => 'Blockchain & Web3 Journey', 'price' => 69.99, 'career_path' => 'Web Development'],
        ];

        foreach ($courses as $index => $c) {
            Course::updateOrCreate(
                ['slug' => Str::slug($c['title'])],
                [
                    'title' => $c['title'],
                    'description' => 'Comprehensive course for ' . $c['title'] . '. Learn from industry experts and build professional projects.',
                    'price' => $c['price'],
                    'instructor_id' => $instructors->random()->id,
                    'category_id' => $categories->random()->id,
                    'career_path' => $c['career_path'],
                    'status' => 'published',
                    'is_featured' => ($index < 3), // First 3 are featured
                    'thumbnail' => 'courses/thumb_' . ($index + 1) . '.jpg',
                ]
            );
        }
    }
}
