@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto">
    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-600 transition-colors duration-150 mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Projects
    </a>

    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <h1 class="text-xl font-semibold text-gray-900 mb-1">{{ $project->name }}</h1>

        <div class="inline-flex items-center gap-1.5 text-xs text-gray-400 mb-5">
            <div class="w-5 h-5 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-semibold uppercase text-[10px]">
                {{ substr($project->owner->name, 0, 1) }}
            </div>
            {{ $project->owner->name }}
        </div>

        @if($project->description)
            <p class="text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mb-5">
                {{ $project->description }}
            </p>
        @else
            <p class="text-gray-400 text-sm italic border-t border-gray-100 pt-4 mb-5">No description provided.</p>
        @endif

        <div class="flex items-center gap-2 pt-2">
            <a href="{{ route('projects.edit', $project) }}"
               class="px-4 py-2 rounded-md bg-indigo-500 text-white text-sm font-medium hover:bg-indigo-600 transition-colors duration-150">
                Edit
            </a>
            <form action="{{ route('projects.destroy', $project) }}" method="POST"
                  onsubmit="return confirm('Delete this project?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 rounded-md border border-gray-200 text-red-500 text-sm font-medium hover:bg-red-50 hover:border-red-200 transition-colors duration-150">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

@endsection