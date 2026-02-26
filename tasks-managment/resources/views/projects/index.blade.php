<h1>Projects</h1>

<a href="{{ route('projects.create') }}">Create New Project</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@foreach($projects as $project)
    <div style="margin-bottom: 20px;">
        <h3>{{ $project->name }}</h3>
        <p>{{ $project->description }}</p>
        <p><strong>Owner:</strong> {{ $project->owner->name }}</p>

        <a href="{{ route('projects.show', $project) }}">View</a>
        <a href="{{ route('projects.edit', $project) }}">Edit</a>

        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach