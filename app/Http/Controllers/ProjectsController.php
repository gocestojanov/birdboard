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

    protected function validation()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'max:255'
        ]);

        return $attributes;
        
    }


    public function store()
    {


        $attributes = $this->validation();    

        $attributes['owner_id'] = auth()->id();

        //dd($attributes);

        //Project::create($attributes);


        $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());

    }

    public function edit(Project $project)
    {   
        return view('project.edit',compact('project'));
    }


    public function update(Project $project)
    {
        // if (auth()->user()->isNot($project->owner) ) {
        //     abort(403);
        // }
        
       $this->authorize('update', $project);     

       $attributes = $this->validation();

        $project->update($attributes);

        return redirect($project->path());

    }


    public function show(Project $project)
    {

        // if (auth()->user()->isNot($project->owner) ) {
        //     abort(403);
        // }

        $this->authorize('update', $project);     


        return view('project.show', compact('project'));
    }

    public function create()
    {
        return view('project.create');
    }

}
