<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('users')->updateOrInsert([
      'id' => 1
    ], [
      'id' => 1,
      'name' => 'admin',
      'email' => 'admin@mail.com',
      'password' =>  Hash::make('Admin2024@'),
    ]);

    DB::table('users')->updateOrInsert([
      'id' => 2
    ], [
      'id' => 2,
      'name' => 'chi',
      'email' => 'chi@mail.com',
      'password' =>  Hash::make('Admin2024@'),
    ]);
  }
}
