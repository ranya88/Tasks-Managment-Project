@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto">

    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 text-sm text-base-content/50 hover:text-base-content transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Projects
    </a>

    <div class="card bg-base-100 shadow">
        <div class="card-body">

            {{-- Project name + owner --}}
            <h1 class="card-title text-xl">{{ $project->name }}</h1>

            <div class="flex items-center gap-2 text-sm text-base-content/50">
                <div class="avatar placeholder">
                    <div class="bg-primary text-primary-content rounded-full w-6 h-6 text-xs font-bold">
                        <span>{{ strtoupper(substr($project->owner->name, 0, 1)) }}</span>
                    </div>
                </div>
                {{ $project->owner->name }}
            </div>

            <divider class="divider my-2"></divider>

            @if($project->description)
                <p class="text-base-content/70 text-sm leading-relaxed">{{ $project->description }}</p>
            @else
                <p class="text-base-content/40 text-sm italic">No description provided.</p>
            @endif

            <div class="card-actions justify-start gap-2 pt-2">
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST"
                      onsubmit="return confirm('Delete this project?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-ghost btn-sm text-error">Delete</button>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection