@extends('layouts.app')

@section('content')

    <div class="flex items-center">
        <a href="/projects/create" class="mr-auto mb-4">Create a new Project</a>
    </div>





<div class="flex">
    @forelse ($projects as $project)


        <div class="bg-white mr-4 p-5 rounded shadow w-1/3" >
                <h3 class="font-normal text-xl py-4"><a href="{{ $project->path() }}">{{ $project->title }}</a></h3>

                <div class="text-gray-500">
                    {{ Str::limit($project->description,150) }}
                </div>

        </div>


    @empty
        <div>No Projects Jet</div>
    @endforelse
</div>

@endsection
