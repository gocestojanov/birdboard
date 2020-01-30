<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;



    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->refreshDatabase();

        $this->withoutExceptionHandling();

        //$this->actingAs(factory('App\User')->create());
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes  = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());


        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {

        $this->signIn();
        //$this->be(factory('App\User')->create());

        $this->withoutExceptionHandling();

        $project = factory('App\Project')->create(['owner_id'=> auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }


    /** @test */
    public function auth_user_cannot_view_others_projects()
    {

        $this->signIn();
        //$this->be(factory('App\User')->create());

        //$this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }




    /** @test */
    public function a_project_requires_a_title()
    {

        $this->signIn();
        //$this->actingAs(factory('App\User')->create());


        $attributes = factory('App\Project')->raw(['title'=>'']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {

        $this->signIn();
        //$this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Project')->raw(['description'=>'']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function guest_can_not_manage_project()
    {
        //$this->withoutExceptionHandling();

        // $attributes = factory('App\Project')->raw(['owner_id'=> null ]);

        // $this->post('/projects', $attributes)->assertSessionHasErrors('owner_id');

        $project = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');




        $this->post('/projects', $project->toArray())->assertRedirect('login');

    }
}