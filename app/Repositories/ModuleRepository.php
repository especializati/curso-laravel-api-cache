<?php

namespace App\Repositories;

use App\Models\Module;
use Illuminate\Support\Facades\Cache;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getModuleCourse(int $courseId)
    {
        return $this->entity
                        ->where('course_id', $courseId)
                        ->get();
    }

    public function createNewModule(int $courseId, array $data)
    {
        $data['course_id'] = $courseId;

        return $this->entity->create($data);
    }

    public function getModuleByCourse(int $courseId, string $identify)
    {
        return $this->entity
                    ->where('course_id', $courseId)
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function getModuleByUuid(string $identify)
    {
        return $this->entity
                    ->where('uuid', $identify)
                    ->firstOrfail();
    }

    public function updateModuleByUuid(int $courseId, string $identify, array $data)
    {
        $module = $this->getModuleByUuid($identify);

        Cache::forget('courses');

        $data['course_id'] = $courseId;
        

        return $module->update($data);
    }

    public function deleteModuleByUuid(string $identify)
    {
        $module = $this->getModuleByUuid($identify);

        Cache::forget('courses');

        return $module->delete();
    }
}