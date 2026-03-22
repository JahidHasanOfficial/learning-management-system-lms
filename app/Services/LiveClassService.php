<?php

namespace App\Services;

use App\Models\LiveClass;
use App\Models\Batch;

class LiveClassService
{
    /**
     * Store a live class.
     */
    public function storeLiveClass(array $data)
    {
        // Integration with Zoom/WebRTC can be here
        // For now, assume it's manual URL or simple logic
        return LiveClass::create($data);
    }

    /**
     * Update a live class.
     */
    public function updateLiveClass(LiveClass $liveClass, array $data)
    {
        $liveClass->update($data);
        return $liveClass;
    }

    /**
     * Delete a live class.
     */
    public function deleteLiveClass(LiveClass $liveClass)
    {
        return $liveClass->delete();
    }

    /**
     * Get upcoming live classes for a batch or course.
     */
    public function getUpcomingClasses($courseId = null, $batchId = null)
    {
        $query = LiveClass::where('start_time', '>=', now())
            ->orderBy('start_time');

        if ($courseId) $query->where('course_id', $courseId);
        if ($batchId) $query->where('batch_id', $batchId);

        return $query->get();
    }
}
