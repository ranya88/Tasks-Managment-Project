@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">
    <div class="mb-6">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-gray-600 transition-colors duration-150 mb-3">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
        <h1 class="text-xl font-semibold text-gray-900">Edit Project</h1>
    </div>

    @if($errors->any())
        <div class="mb-5 px-4 py-3 rounded-md bg-red-50 border border-red-200 text-red-600 text-sm">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Project Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required
                       class="w-full px-3 py-2 rounded-md border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-150">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-3 py-2 rounded-md border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-150 resize-none">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-1">
                <button type="submit"
                        class="flex-1 py-2 rounded-md bg-indigo-500 text-white text-sm font-medium hover:bg-indigo-600 transition-colors duration-150">
                    Save Changes
                </button>
                <a href="{{ route('projects.index') }}"
                   class="flex-1 text-center py-2 rounded-md border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition-colors duration-150">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection