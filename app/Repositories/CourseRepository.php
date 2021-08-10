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
        return $this->entity->get();
    }

    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrfail();
    }

    public function deleteCourseByUuid(string $identify)
    {
        $course = $this->getCourseByUuid($identify);

        return $course->delete();
    }

}
