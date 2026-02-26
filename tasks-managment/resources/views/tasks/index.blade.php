@extends('layouts.app')

@section('content')

{{-- Page header --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Tasks</h1>
        <p class="text-slate-400 text-sm mt-1">All tasks across your workspace</p>
    </div>
    <a href="{{ route('tasks.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-indigo-500 to-violet-600 text-white text-sm font-semibold shadow-lg shadow-indigo-900/40 hover:from-indigo-400 hover:to-violet-500 transition-all duration-150 active:scale-95">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        New Task
    </a>
</div>

{{-- Flash message --}}
@if(session('success'))
    <div class="flex items-center gap-3 mb-6 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm">
        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

{{-- Table card --}}
<div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl shadow-black/20">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-800 bg-slate-800/50">
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Title</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Description</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Priority</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Due Date</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Assigned To</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($tasks as $task)
                <tr class="hover:bg-slate-800/40 transition-colors duration-100">

                    {{-- Title --}}
                    <td class="px-5 py-4 font-medium text-white">{{ $task->title }}</td>

                    {{-- Description --}}
                    <td class="px-5 py-4 text-slate-400 max-w-xs">
                        <span class="line-clamp-1">{{ $task->description ?: '—' }}</span>
                    </td>

                    {{-- Status select --}}
                    <td class="px-5 py-4">
                        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                    class="appearance-none text-xs font-semibold px-2.5 py-1 rounded-full border cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-transparent transition-all duration-150
                                    {{ $task->status === 'done'        ? 'text-emerald-400 border-emerald-500/40 bg-emerald-500/10' : '' }}
                                    {{ $task->status === 'in_progress' ? 'text-amber-400 border-amber-500/40 bg-amber-500/10'     : '' }}
                                    {{ $task->status === 'todo'        ? 'text-slate-400 border-slate-600 bg-slate-800'            : '' }}">
                                <option value="todo"        {{ $task->status === 'todo'        ? 'selected' : '' }}>To Do</option>
                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done"        {{ $task->status === 'done'        ? 'selected' : '' }}>Done</option>
                            </select>
                        </form>
                    </td>

                    {{-- Priority badge --}}
                    <td class="px-5 py-4">
                        @php
                            $pClass = match($task->priority) {
                                'high'   => 'text-red-400 border-red-500/40 bg-red-500/10',
                                'medium' => 'text-orange-400 border-orange-500/40 bg-orange-500/10',
                                default  => 'text-blue-400 border-blue-500/40 bg-blue-500/10',
                            };
                        @endphp
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full border {{ $pClass }}">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </td>

                    {{-- Due date --}}
                    <td class="px-5 py-4 text-slate-400">
                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M j, Y') : '—' }}
                    </td>

                    {{-- Assign select --}}
                    <td class="px-5 py-4">
                        <form action="{{ route('tasks.updateAssignment', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="assigned_user_id" onchange="this.form.submit()"
                                    class="appearance-none text-xs text-slate-300 bg-slate-800 border border-slate-700 rounded-lg px-2.5 py-1.5 cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-150">
                                <option value="">Unassigned</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $task->assigned_user_id === $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>

                    {{-- Actions --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('tasks.edit', $task) }}"
                               class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-700 transition-all duration-150"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                  onsubmit="return confirm('Delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-all duration-150"
                                        title="Delete">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-16 text-center text-slate-500">
                        <svg class="w-10 h-10 mx-auto mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-sm">No tasks yet. Create your first one!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
