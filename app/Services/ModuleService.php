<?php

namespace App\Services;

use App\Repositories\{
    CourseRepository,
    ModuleRepository
};

class ModuleService
{
    protected $moduleRepository, $courseRepository;

    public function __construct(
        ModuleRepository $moduleRepository,
        CourseRepository $courseRepository
    ) {
        $this->moduleRepository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getModulesByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->getModuleCourse($course->id);
    }

    public function createNewModule(array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        return $this->moduleRepository->createNewModule($course->id, $data);
    }

    public function getModuleByCourse(string $course, string $identify)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->getModuleByCourse($course->id, $identify);
    }

    public function updateModule(string $identify, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        return $this->moduleRepository->updateModuleByUuid($course->id, $identify, $data);
    }

    public function deleteModule(string $identify)
    {
        return $this->moduleRepository->deleteModuleByUuid($identify);
    }
}