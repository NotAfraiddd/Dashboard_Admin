<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

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
        'name' => 'Not Start',
        'color' => '#ffffff',
      ],
      [
        'id' => 2,
        'name' => 'In Process',
        'color' => '#fed7aa',
      ],
      [
        'id' => 3,
        'name' => 'Pending',
        'color' => '#1d4ed8',
      ],
      [
        'id' => 4,
        'name' => 'Done',
        'color' => '#22c55e',
      ],
    ];

    foreach ($statuses as $statusData) {
      Status::updateOrInsert(['id' => $statusData['id']], $statusData);
    }
  }
}
