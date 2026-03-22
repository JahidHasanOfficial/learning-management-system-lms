<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Web Development', 'Mobile Apps', 'Design', 'Marketing', 'Business'];
        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat)],
                ['name' => $cat, 'description' => $cat . ' related courses.']
            );
        }
    }
}
