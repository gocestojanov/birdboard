@extends('layouts.app')

@section('content')

<header class="flex items-center py-4">
    <div class="flex justify-between  w-full">

        <p>
            <a href="/projects" class="">My Projects / {{ $project->title }}</a>
        </p>

        <a href="{{ $project->path() . '/edit' }}"   class="button">Edit Project</a>
    </div>
</header>


    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">

                <div class="mb-8">
                    <h2 class="text-lg tx-gray-300 mb-3">Tasks</h2>


                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                        <form action="{{ $task->path() }}" method="POST" >
                            @method('PATCH')
                            @csrf
                            <div class="flex">
                                <input value="{{ $task->body }}" class="w-full ml-4 {{ $task->completed ? 'text-gray-400' : '' }}" name="body" >
                                <label class="container1">
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                  </label>

                            </div>
                        </form>
                        </div>

                    @endforeach



                    <form action="{{ $project->path() . '/tasks' }}" method="POST">
                        @csrf
                        <input  placeholder="Begin adding tasks..." class="w-full card" name="body">
                    </form>


                </div>

                <div>
                    <h2 class="text-lg  tx-gray-300 mb-3">General Notes</h2>

                <form action="{{ $project->path() }}" method="POST" >
                    @csrf
                    @method('PATCH')
                    <textarea
                            name="notes"
                            class="card w-full" 
                            style="min-height: 200px" 
                            placeholder="Anything special that you want to make a note of?">{{ $project->notes }} 
                    </textarea>
                    <button type="submit" class="button">Save </button>    
                </form>

                </div>
            </div>

            <div class="lg:w-1/4 px-3">

                @include('project.card')

            </div>


        </div>
    </main>

@endsection



