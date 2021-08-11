<?php

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Support\Facades\Cache;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getLessonsModule(int $moduleId)
    {
        return $this->entity
                        ->where('module_id', $moduleId)
                        ->get();
    }

    public function createNewLesson(int $moduleId, array $data)
    {
        $data['module_id'] = $moduleId;

        return $this->entity->create($data);
    }

    public function getLessonByModule(int $moduleId, string $identify)
    {
        return $this->entity
                    ->where('module_id', $moduleId)
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function getLessonByUuid(string $identify)
    {
        return $this->entity
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function updateLessonByUuid(int $moduleId, string $identify, array $data)
    {
        $lesson = $this->getLessonByUuid($identify);

        $data['module_id'] = $moduleId;

        Cache::forget('courses');

        return $lesson->update($data);
    }

    public function deleteLessonByUuid(string $identify)
    {
        $lesson = $this->getLessonByUuid($identify);

        Cache::forget('courses');

        return $lesson->delete();
    }
}