<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\ProjectFactory;
use Tests\TestCase;


class ProjectTasksTest extends TestCase
{

    use RefreshDatabase;


    /** @test */

    public function a_project_can_have_tasks()
    {

        // $this->signIn();

        // // $project = factory(\App\Project::class)->create(['owner_id' => auth()->id()]);

        // $project = \auth()->user()->projects()->create(
        //     factory(\App\Project::class)->raw()
        // );


        $project = ProjectFactory::create();


        $this->actingAs($project->owner)
            ->post($project->path() .  '/tasks', ['body' => 'Test task']);

        $this->get($project->path())->assertSee('Test task');

    }

    /** @test */
    public function a_project_can_be_updated()
    {

        // $this->withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();


        $this->actingAs($project->owner)->patch($project->tasks->first()->path(), [

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

        $project = ProjectFactory::create();


        $attributes = \factory('App\Task')->raw(['body' => '' ]);


        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');


    }

    /** @test */
    public function only_project_owner_can_add_tasks()
    {
        $this->signIn();

        $project = ProjectFactory::create();


        $this->post($project->path() .  '/tasks', ['body' => 'Test task'])
                         ->assertStatus(403);

        $this->assertDatabaseMissing('tasks',['body' => 'Test task' ]);

    }

    /** @test */
    public function only_project_owner_can_update_tasks()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();


        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
                         ->assertStatus(403);

        $this->assertDatabaseMissing('tasks',['body' => 'changed' ]);

    }




}
