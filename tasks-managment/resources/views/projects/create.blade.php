@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">

    {{-- Back link + header --}}
    <div class="mb-6">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 text-sm text-base-content/50 hover:text-base-content transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Projects
        </a>
        <h1 class="text-2xl font-bold tracking-tight">Create Project</h1>
        <p class="text-base-content/60 text-sm mt-1">Add a new project to your workspace</p>
    </div>

    {{-- Validation errors --}}
    @if($errors->any())
        <div role="alert" class="alert alert-error mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <ul class="list-disc list-inside text-sm space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form card --}}
    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="form-control">
                    <label class="label" for="name">
                        <span class="label-text font-medium">Project Name</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           placeholder="e.g. Website Redesign"
                           class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}">
                </div>

                <div class="form-control">
                    <label class="label" for="description">
                        <span class="label-text font-medium">Description <span class="text-base-content/40 font-normal">(optional)</span></span>
                    </label>
                    <textarea name="description" id="description" rows="4"
                              placeholder="What is this project about?"
                              class="textarea textarea-bordered w-full resize-none {{ $errors->has('description') ? 'textarea-error' : '' }}">{{ old('description') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn btn-primary flex-1">Create Project</button>
                    <a href="{{ route('projects.index') }}" class="btn btn-ghost flex-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection