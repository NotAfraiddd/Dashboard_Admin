<?php

namespace Database\Seeders;

use App\Models\TaskFollower;
use Illuminate\Database\Seeder;

class TaskFollowerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $taskFollowers = [
      [
        'id' => 1,
        'user_id' => 1,
        'task_id' => 1,
      ],
      [
        'id' => 2,
        'user_id' => 1,
        'task_id' => 2,
      ],
      [
        'id' => 3,
        'user_id' => 2,
        'task_id' => 1,
      ],
    ];

    foreach ($taskFollowers as $followerData) {
      TaskFollower::updateOrInsert(['id' => $followerData['id']], $followerData);
    }
  }
}
