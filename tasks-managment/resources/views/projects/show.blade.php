<h1>{{ $project->name }}</h1>

<p>{{ $project->description }}</p>
<p><strong>Owner:</strong> {{ $project->owner->name }}</p>

<a href="{{ route('projects.index') }}">Back</a>