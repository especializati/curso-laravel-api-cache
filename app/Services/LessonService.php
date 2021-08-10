<?php

namespace App\Services;

use App\Repositories\{
    LessonRepository,
    ModuleRepository
};

class LessonService
{
    protected $lessonRepository, $moduleRepository;

    public function __construct(
        LessonRepository $lessonRepository,
        ModuleRepository $moduleRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getLessonsByModule(string $module)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->lessonRepository->getLessonsModule($module->id);
    }

    public function createNewLesson(array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->lessonRepository->createNewLesson($module->id, $data);
    }

    public function getLessonByModule(string $module, string $identify)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->lessonRepository->getLessonByModule($module->id, $identify);
    }

    public function updateLesson(string $identify, array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->lessonRepository->updateLessonByUuid($module->id, $identify, $data);
    }

    public function deleteLesson(string $identify)
    {
        return $this->lessonRepository->deleteLessonByUuid($identify);
    }
}