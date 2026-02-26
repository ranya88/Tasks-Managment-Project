@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-xl font-semibold text-gray-900">Projects</h1>
    <a href="{{ route('projects.create') }}"
       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-md bg-indigo-500 text-white text-sm font-medium hover:bg-indigo-600 transition-colors duration-150">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        New Project
    </a>
</div>

@if(session('success'))
    <div class="mb-5 px-4 py-2.5 rounded-md bg-green-50 border border-green-200 text-green-700 text-sm">
        {{ session('success') }}
    </div>
@endif

@if($projects->isEmpty())
    <div class="text-center py-20 text-gray-400 text-sm">
        No projects yet. <a href="{{ route('projects.create') }}" class="text-indigo-500 hover:underline">Create your first one.</a>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($projects as $project)
        <div class="bg-white border border-gray-200 rounded-xl p-5 flex flex-col gap-3 hover:border-gray-300 hover:shadow-sm transition-all duration-150">

            <div class="flex-1">
                <h3 class="font-medium text-gray-900 truncate mb-1">{{ $project->name }}</h3>
                <p class="text-gray-400 text-sm line-clamp-2 leading-relaxed">
                    {{ $project->description ?: 'No description.' }}
                </p>
            </div>

            <div class="flex items-center gap-1.5 text-xs text-gray-400 pt-1 border-t border-gray-100">
                <div class="w-5 h-5 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-semibold uppercase text-[10px]">
                    {{ substr($project->owner->name, 0, 1) }}
                </div>
                {{ $project->owner->name }}
            </div>

            <div class="flex items-center gap-1.5">
                <a href="{{ route('projects.show', $project) }}"
                   class="flex-1 text-center py-1.5 text-xs font-medium text-gray-600 hover:text-gray-900 border border-gray-200 rounded-md hover:border-gray-300 transition-colors duration-150">View</a>
                <a href="{{ route('projects.edit', $project) }}"
                   class="flex-1 text-center py-1.5 text-xs font-medium text-gray-600 hover:text-gray-900 border border-gray-200 rounded-md hover:border-gray-300 transition-colors duration-150">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Delete this project?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full py-1.5 text-xs font-medium text-red-500 hover:text-red-600 border border-gray-200 rounded-md hover:border-red-200 transition-colors duration-150">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection