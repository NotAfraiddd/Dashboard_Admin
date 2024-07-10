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
        'name' => 'Not Start',

      ],
      [
        'id' => 2,
        'name' => 'In Process',
      ],
      [
        'id' => 3,
        'name' => 'Pending',

      ],
      [
        'id' => 4,
        'name' => 'Done',
      ],
    ];

    foreach ($statuses as $statusData) {
      Status::updateOrInsert(['id' => $statusData['id']], $statusData);
    }
  }
}