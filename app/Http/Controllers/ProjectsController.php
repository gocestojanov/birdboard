<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        //$projects = Project::all();
        $projects = auth()->user()->projects;

        return view('project.index', compact('projects'));
    }

    public function store()
    {





        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $attributes['owner_id'] = auth()->id();

        //dd($attributes);

        //Project::create($attributes);


        $project = auth()->user()->projects()->create($attributes);

        return redirect($projects->path());

    }

    public function show(Project $project)
    {

        if (auth()->user()->isNot($project->owner) ) {
            abort(403);
        }

        return view('project.show', compact('project'));
    }

    public function create()
    {
        return view('project.create');
    }

}
