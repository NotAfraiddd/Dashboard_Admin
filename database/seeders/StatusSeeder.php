<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $statuses = [
      [
        'id' => 1,
        'task_id' => 2,
        'name' => 'Not Start',
        'color' => '#ffffff',
      ],
      [
        'id' => 2,
        'task_id' => 2,
        'name' => 'In Process',
        'color' => '#fed7aa',
      ],
      [
        'id' => 3,
        'task_id' => 2,
        'name' => 'Pending',
        'color' => '#1d4ed8',
      ],
      [
        'id' => 4,
        'task_id' => 2,
        'name' => 'Done',
        'color' => '#22c55e',
      ],
    ];

    foreach ($statuses as $statusData) {
      Status::updateOrInsert(['id' => $statusData['id']], $statusData);
    }
  }
}
