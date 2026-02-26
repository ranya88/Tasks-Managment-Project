@extends('layouts.app')

@section('content')
<h1>Create Project</h1>

@if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('projects.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Project Name:</label>
        <input 
            type="text" 
            name="name" 
            id="name" 
            value="{{ old('name') }}" 
            required
        >
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea 
            name="description" 
            id="description"
        >{{ old('description') }}</textarea>
    </div>

    <div>
        <button type="submit">Create Project</button>
        <a href="{{ route('projects.index') }}">Cancel</a>
    </div>
</form>
@endsection