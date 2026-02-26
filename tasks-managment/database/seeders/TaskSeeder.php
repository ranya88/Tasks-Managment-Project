<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $users = User::all();

        foreach ($projects as $project) {
            Task::create([
                'project_id' => $project->id,
                'assigned_user_id' => $users->random()->id,
                'title' => 'Sample Task for ' . $project->name,
                'description' => 'This is a seeded task.',
                'status' => 'todo',
                'priority' => 'medium',
                'due_date' => now()->addDays(7),
            ]);
        }
    }
}