@extends('layout')

@section('content')

<h1 class="title">Create a New Project</h1>

<form action="/projects" method="post">

    @csrf

    <div class="field">
        <label class="label" for="title">Project Title</label>
        <input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="text" name="title" value="{{ old('title') }}" required>
    </div>

    <div class="field">
        <label class="label" for="description">Project Description</label>
        <textarea class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}" name="description" required>{{ old('description') }} </textarea>
    </div>

    <div class="field">
        <button class="button is-link" type="submit">Create Project</button>
    </div>

    

    @include('errors')

</form>

    
@endsection
