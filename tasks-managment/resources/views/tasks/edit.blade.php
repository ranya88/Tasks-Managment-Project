@extends('layouts.app')

@section('content')
<h1>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h1>

<form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
    @csrf
    @if(isset($task))
        @method('PUT')
    @endif

    <label>Title:</label>
    <input type="text" name="title" value="{{ old('title', $task->title ?? '') }}" required><br>

    <label>Description:</label>
    <textarea name="description">{{ old('description', $task->description ?? '') }}</textarea><br>

    <label>Status:</label>
    <select name="status" required>
        @foreach(['todo','in_progress','done'] as $status)
            <option value="{{ $status }}" @selected(old('status', $task->status ?? '') == $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select><br>

    <label>Priority:</label>
    <select name="priority" required>
        @foreach(['low','medium','high'] as $priority)
            <option value="{{ $priority }}" @selected(old('priority', $task->priority ?? '') == $priority)>{{ ucfirst($priority) }}</option>
        @endforeach
    </select><br>

    <label>Due Date:</label>
    <input type="date" name="due_date" value="{{ old('due_date', isset($task->due_date) ? $task->due_date : '') }}"><br>

    <label>Assign User:</label>
    <select name="assigned_user_id">
        <option value="">-- Unassigned --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" @selected(old('assigned_user_id', $task->assigned_user_id ?? '') == $user->id)>{{ $user->name }}</option>
        @endforeach
    </select><br>

    <button type="submit">{{ isset($task) ? 'Update' : 'Create' }}</button>
</form>
@endsection
