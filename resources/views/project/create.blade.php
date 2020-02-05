<!DOCTYPE html>
@extends('layouts.app')

@section('content')

<h1 class="heading is-1">
    Create Project
</h1>


    <form   method="POST" action="/projects">
        @csrf



        @include('project.form',['project' => new App\Project, 'buttonText' => 'Create Project'])

    </form>

        {{-- @csrf

        <h1 class="heading is-1">
            Create a project
        </h1>

        <div class="field">
            <label for="title" class="label">Title</label>

            <div class="control">
                    <input type="text" name="title" id="" class="input" placeholder="Title">
            </div>
        </div>
        <div class="field">
            <label for="description" class="label">Description</label>

            <div class="control">
                    <textarea name="description" id="" cols="30" rows="10" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">


            <div class="control">
                    <button type="submit" class="button is-link">Create Project</button>
            </div>


            <a href="/projects">Cancel</a>


        </div> --}}




@endsection
