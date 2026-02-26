<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Project::create([
                'name' => 'Project for ' . $user->name,
                'description' => 'Sample project description',
                'owner_id' => $user->id,
            ]);
        }
    }
}