<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            SectionSeeder::class,
            LessonSeeder::class,
            BatchSeeder::class,
            LiveClassSeeder::class,
            LiveClassAttendanceSeeder::class,
            LiveClassChatSeeder::class,
            CourseUserSeeder::class,
            QuizSeeder::class,
            QuizQuestionSeeder::class,
            QuizSubmissionSeeder::class,
            AssignmentSeeder::class,
            AssignmentSubmissionSeeder::class,
            GradebookSeeder::class,
            SupportTicketSeeder::class,
            TicketMessageSeeder::class,
            ConsultationSlotSeeder::class,
            MentorAssignmentSeeder::class,
            CourseQnaSeeder::class,
            CouponSeeder::class,
            InvoiceSeeder::class,
            PaymentSeeder::class,
            InstallmentSeeder::class,
            RefundRequestSeeder::class,
        ]);
    }
}
