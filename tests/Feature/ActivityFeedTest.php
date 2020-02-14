<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\ProjectFactory;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function creating_a_project_records_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);

        $this->assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    public function updateing_projects_records_activity()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activity);

        $this->assertEquals('updated', $project->activity->last()->description);
    }

    /** @test */
    public function creating_new_task_records_projects_activity()
    {
        $project = ProjectFactory::create();

        $project->addTask('some task');

        // dd($project->activity);

        $this->assertCount(2, $project->activity);

    }

    /** @test */
    public function completing_new_task_records_projects_activity()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true,


        ] );

        $this->assertCount(3, $project->activity);


        $this->assertEquals('completed_task', $project->activity->last()->description);


    }

}
