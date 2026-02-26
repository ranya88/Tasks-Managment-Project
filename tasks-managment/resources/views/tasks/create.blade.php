@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto">

    {{-- Page header --}}
    <div class="mb-6">
        <a href="{{ route('tasks.index') }}" class="inline-flex items-center gap-1 text-slate-400 hover:text-slate-200 text-sm transition-colors duration-150 mb-4">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Tasks
        </a>
        <h1 class="text-2xl font-bold text-white tracking-tight">Create Task</h1>
        <p class="text-slate-400 text-sm mt-1">Add a new task to your workspace</p>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="mb-6 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
            <p class="font-medium mb-1">Please fix the following errors:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form card --}}
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl shadow-black/20">
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-slate-300 mb-1.5">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       placeholder="e.g. Design landing page"
                       class="w-full px-3.5 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-150">
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-slate-300 mb-1.5">Description <span class="text-slate-500">(optional)</span></label>
                <textarea name="description" id="description" rows="3"
                          placeholder="Describe the task..."
                          class="w-full px-3.5 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-150 resize-none">{{ old('description') }}</textarea>
            </div>

            {{-- Status & Priority row --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-300 mb-1.5">Status</label>
                    <select name="status" id="status" required
                            class="w-full px-3.5 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-150">
                        @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $val => $label)
                            <option value="{{ $val }}" @selected(old('status') == $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="priority" class="block text-sm font-medium text-slate-300 mb-1.5">Priority</label>
                    <select name="priority" id="priority" required
                            class="w-full px-3.5 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-150">
                        @foreach(['low', 'medium', 'high'] as $priority)
                            <option value="{{ $priority }}" @selected(old('priority') == $priority)>{{ ucfirst($priority) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Due Date --}}
            <div>
                <label for="due_date" class="block text-sm font-medium text-slate-300 mb-1.5">Due Date <span class="text-slate-500">(optional)</span></label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                       class="w-full px-3.5 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-150 [color-scheme:dark]">
            </div>

            {{-- Assign User --}}
            <div>
                <label for="assigned_user_id" class="block text-sm font-medium text-slate-300 mb-1.5">Assign to User <span class="text-slate-500">(optional)</span></label>
                <select name="assigned_user_id" id="assigned_user_id"
                        class="w-full px-3.5 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-150">
                    <option value="">— Unassigned —</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected(old('assigned_user_id') == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="flex-1 py-2.5 px-5 rounded-lg bg-gradient-to-r from-indigo-500 to-violet-600 text-white text-sm font-semibold shadow-lg shadow-indigo-900/40 hover:from-indigo-400 hover:to-violet-500 transition-all duration-150 active:scale-95">
                    Create Task
                </button>
                <a href="{{ route('tasks.index') }}"
                   class="flex-1 text-center py-2.5 px-5 rounded-lg border border-slate-700 text-slate-300 text-sm font-medium hover:bg-slate-800 hover:text-white transition-all duration-150">
                    Cancel
                </a>
            </div>

        </form>
    </div>

</div>

@endsection
