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

            @include('project.card')
        </div>



        @empty
            <div>No Projects Jet</div>
        @endforelse
    </main>

@endsection
