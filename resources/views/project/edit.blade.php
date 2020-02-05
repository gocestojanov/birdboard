<!DOCTYPE html>
@extends('layouts.app')

@section('content')

<h1 class="heading is-1">
    Edit your project
</h1>


<form   method="POST" action="{{ $project->path() }}" >
    @csrf
    @method('PATCH')




    @include('project.form',['buttonText' => 'Update Project'])
</form>
@endsection
