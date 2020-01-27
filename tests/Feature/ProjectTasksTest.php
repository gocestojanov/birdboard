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



}
