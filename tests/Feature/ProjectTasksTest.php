<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ProjectTasksTest extends TestCase
{

    use RefreshDatabase;


    /** @test */

    public function a_project_can_have_tasks()
    {

        $this->signIn();

        // $project = factory(\App\Project::class)->create(['owner_id' => auth()->id()]);

        $project = \auth()->user()->projects()->create(
            factory(\App\Project::class)->raw()
        );

        $this->post($project->path() .  '/tasks', ['body' => 'Test task']);

        $this->get($project->path())->assertSee('Test task');

    }

    /** @test */
    public function a_project_can_be_updated()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $project = \auth()->user()->projects()->create(
            factory(\App\Project::class)->raw()
        );

        $task = $project->addTask('test task');

        // dd($project->path());

        $this->patch($project->path() . '/tasks/' . $task->id, [

            'body' => 'changed',
            'completed' => true

        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);

    }




    /** @test */
    public function a_task_requires_body()
    {
        $this->signIn();

        $project = \auth()->user()->projects()->create(
            factory(\App\Project::class)->raw()
        );

        $attributes = \factory('App\Task')->raw(['body' => '' ]);


        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');


    }

    /** @test */
    public function only_project_owner_can_add_tasks()
    {
        $this->signIn();

        $project = factory(\App\Project::class)->create();

        $this->post($project->path() .  '/tasks', ['body' => 'Test task'])
                         ->assertStatus(403);

        $this->assertDatabaseMissing('tasks',['body' => 'Test task' ]);

    }

    /** @test */
    public function only_project_owner_can_update_tasks()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $task = $project->addTask('test task');

        $this->patch($task->path(), ['body' => 'changed'])
                         ->assertStatus(403);

        $this->assertDatabaseMissing('tasks',['body' => 'changed' ]);

    }




}
