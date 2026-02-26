<h1>Edit Project</h1>

<form action="{{ route('projects.update', $project) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $project->name }}" required>
    <br><br>

    <label>Description:</label>
    <textarea name="description">{{ $project->description }}</textarea>
    <br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('projects.index') }}">Back</a>