<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $existingUser = User::where('email', 'demo@example.com')->first();

        if (!$existingUser) {
            User::factory()->create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
            ]);
        }

        $users = User::factory()->count(3)->create();
        $tasks = Task::factory()->count(5)->create();

        //Populate task_user table using TaskUser model
        $tasks->each(function ($task) use ($users) {
            // Attach between 1 to 3 random users to each task via TaskUser model
            $users->random(rand(1, 3))->each(function ($user) use ($task) {
                TaskUser::create([
                    'task_id' => $task->id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
        });
    }
}
