<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $tasks = [
      [
        'id' => 1,
        'title' => 'Task 1',
        'description' => 'Description of Task 1',
        'deadline' => now()->addDays(7),
      ],
      [
        'id' => 2,
        'title' => 'Task 2',
        'description' => 'Description of Task 2',
        'deadline' => now()->addDays(14),
      ],
    ];

    foreach ($tasks as $taskData) {
      Task::updateOrInsert(['id' => $taskData['id']], $taskData);
    }
  }
}
