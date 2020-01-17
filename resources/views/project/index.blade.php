@extends('layouts.app')

@section('content')

    <div class="flex items-center">


        <a href="/projects/create" class="mr-auto mb-4">Create a new Project</a>
    </div>

    <ul>
    @forelse ($projects as $project)
        <li><a href="{{ $project->path() }}">{{ $project->title }}</a></li>
    @empty
        <h1>No Projects Jet</h1>
    @endforelse
    </ul>

@endsection
