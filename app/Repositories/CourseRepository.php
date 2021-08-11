<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        return $this->entity
                    ->with('modules.lessons')
                    ->get();
    }

    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUuid(string $identify, bool $loadRelationships = true)
    {
        return $this->entity
                    ->where('uuid', $identify)
                    ->with([$loadRelationships ? 'modules.lessons' : ''])
                    ->firstOrfail();
    }

    public function deleteCourseByUuid(string $identify)
    {
        $course = $this->getCourseByUuid($identify, false);

        return $course->delete();
    }

    public function updateCourseByUuid(string $identify, array $data)
    {
        $course = $this->getCourseByUuid($identify, false);

        return $course->update($data);
    }
}
