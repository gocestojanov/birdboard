@extends('layouts.app')

@section('content')

    <header class="flex items-center py-4">
        <div class="flex justify-between  w-full">
            <h2 class="tx-small">My Projects</h2>
            <a href="/projects/create" class="button">Create a new Project</a>
        </div>
    </header>





    <main class="lg:flex flex-wrap -mx-3">
        @forelse ($projects as $project)

            <div class="lg:w-1/3 px-3 pb-6">
                <div class="bg-white p-5 rounded-lg shadow" >
                        <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-300 pl-4"><a href="{{ $project->path() }}">{{ $project->title }}</a></h3>

                        <div class="text-gray-500">
                            {{ Str::limit($project->description,150) }}
                        </div>

                </div>
            </div>

        @empty
            <div>No Projects Jet</div>
        @endforelse
    </main>

@endsection
