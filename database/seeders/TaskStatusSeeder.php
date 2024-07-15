<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $statuses = [
      [
        'task_id' => 1,
        'status_id' => 1,
      ],
      [
        'task_id' => 1,
        'status_id' => 2,
      ],
      [
        'task_id' => 2,
        'status_id' => 3,
      ],
      [
        'task_id' => 2,
        'status_id' => 4,
      ],
    ];

    foreach ($statuses as $statusData) {
      TaskStatus::updateOrInsert($statusData);
    }
  }
}
