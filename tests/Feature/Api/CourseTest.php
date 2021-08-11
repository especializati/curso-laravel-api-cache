<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_courses()
    {
        $response = $this->getJson('/courses');

        $response->assertStatus(200);
    }

    public function test_get_count_courses()
    {
        Course::factory()->count(10)->create();

        $response = $this->getJson('/courses');

        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    public function test_notfound_courses()
    {
        $response = $this->getJson('/courses/fake_value');

        $response->assertStatus(404);
    }

    public function test_get_course()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_course()
    {
        $response = $this->postJson('/courses', []);

        $response->assertStatus(422);
    }

    public function test_create_course()
    {
        $response = $this->postJson('/courses', [
            'name' => 'Novo Curso'
        ]);

        $response->assertStatus(201);
    }

    public function test_validation_update_course()
    {
        $course = Course::factory()->create();

        $response = $this->putJson("/courses/{$course->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_404_update_course()
    {
        $response = $this->putJson('/courses/fake_value', [
            'name' => 'Course Updated'
        ]);

        $response->assertStatus(404);
    }

    public function test_update_course()
    {
        $course = Course::factory()->create();

        $response = $this->putJson("/courses/{$course->uuid}", [
            'name' => 'Course Updated'
        ]);

        $response->assertStatus(200);
    }

    public function test_404_delete_course()
    {
        $response = $this->deleteJson('/courses/fake_value');

        $response->assertStatus(404);
    }

    public function test_delete_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("/courses/{$course->uuid}");

        $response->assertStatus(204);
    }
}
