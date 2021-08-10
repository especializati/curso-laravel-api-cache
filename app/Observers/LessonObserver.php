<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Lesson;

class LessonObserver
{
    /**
     * Handle the Lesson "creating" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function creating(Lesson $lesson)
    {
        $lesson->uuid = (string) Str::uuid();
    }
}
