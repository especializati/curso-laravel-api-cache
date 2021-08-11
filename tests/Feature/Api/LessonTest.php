<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonTest extends TestCase
{
     /**
     * Test Get ALL Lessons By Module
     *
     * @return void
     */
    public function test_get_all_lessons_by_module()
    {
        $module = Module::factory()->create();

        Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons");

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }

    public function test_notfound_lessons_by_module()
    {
        $response = $this->getJson('/modules/fake_value/lessons');

        $response->assertStatus(404);
    }

    public function test_get_lesson_by_module()
    {
        $module = Module::factory()->create();

        $lesson = Lesson::factory()->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/{$module->uuid}/lessons", []);

        $response->assertStatus(422);
    }

    public function test_create_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/{$module->uuid}/lessons", [
            'module' => $module->uuid,
            'name' => 'Aula 01',
            'video' => uniqid(date('YmdHis')),
        ]);

        $response->assertStatus(201);
    }

    public function test_validations_update_lesson_by_module()
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_lesson_by_module()
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}", [
            'module' => $module->uuid,
            'name' => 'Aula Updated',
            'video' => uniqid(date('YmdHis')),
        ]);

        $response->assertStatus(200);
    }

    public function test_notfound_delete_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->deleteJson("/modules/{$module->uuid}/lessons/fake_module");

        $response->assertStatus(404);
    }

    public function test_delete_lesson_by_module()
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->deleteJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}");

        $response->assertStatus(204);
    }
}
