@extends('layouts.app')

@section('content')
<h1>Create Task</h1>

@if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <label for="status">Status:</label>
        <select name="status" id="status" required>
            @foreach(['todo', 'in_progress', 'done'] as $status)
                <option value="{{ $status }}" @selected(old('status') == $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="priority">Priority:</label>
        <select name="priority" id="priority" required>
            @foreach(['low', 'medium', 'high'] as $priority)
                <option value="{{ $priority }}" @selected(old('priority') == $priority)>{{ ucfirst($priority) }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}">
    </div>

    <div>
        <label for="assigned_user_id">Assign to User:</label>
        <select name="assigned_user_id" id="assigned_user_id">
            <option value="">-- Unassigned --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(old('assigned_user_id') == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">Create Task</button>
        <a href="{{ route('tasks.index') }}">Cancel</a>
    </div>
</form>
@endsection
