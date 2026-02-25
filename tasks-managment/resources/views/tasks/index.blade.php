@extends('layouts.app')

@section('content')
<h1>Tasks</h1>
<a href="{{ route('tasks.create') }}">Create Task</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1" cellpadding="5">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Due Date</th>
        <th>Assigned User</th>
        <th>Actions</th>
    </tr>
    @foreach($tasks as $task)
    <tr>
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>

<form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
    @csrf
    @method('PATCH')

    <select name="status" onchange="this.form.submit()">
        <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>
            To Do
        </option>
        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>
            In Progress
        </option>
        <option value="done" {{ $task->status === 'done' ? 'selected' : '' }}>
            Done
        </option>
    </select>
</form>

                </td>
        <td>{{ $task->priority }}</td>
        <td>{{ $task->due_date }}</td>
        <td>
        <form action="{{ route('tasks.updateAssignment', $task) }}" method="POST">
            @csrf
            @method('PATCH')

            <select name="assigned_user_id" onchange="this.form.submit()">
                <option value="">Unassigned</option>

                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $task->assigned_user_id === $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </form>
        </td>
        <td>
            <a href="{{ route('tasks.edit', $task) }}">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this task?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
