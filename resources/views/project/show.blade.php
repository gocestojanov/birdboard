@extends('layouts.app')

@section('content')

<header class="flex items-center py-4">
    <div class="flex justify-between  w-full">

        <p>
            <a href="/projects" class="">My Projects / {{ $project->title }}</a>
        </p>

        <a href="/projects/create" class="button">Create a new Project</a>
    </div>
</header>


    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">

                <div class="mb-8">
                    <h2 class="text-lg tx-gray-300 mb-3">Tasks</h2>

                    <div class="card mb-3">Lorem Ipsum</div>
                    <div class="card mb-3">Lorem Ipsum</div>
                    <div class="card mb-3">Lorem Ipsum</div>
                    <div class="card mb-3">Lorem Ipsum</div>
                    <div class="card ">Lorem Ipsum</div>

                </div>

                <div>
                    <h2 class="text-lg  tx-gray-300 mb-3">General Notes</h2>


                    <textarea class="card w-full" style="min-height: 200px">Lorem Ipsum</textarea>

                </div>
            </div>

            <div class="lg:w-1/4 px-3">

                @include('project.card')

            </div>


        </div>
    </main>

@endsection



