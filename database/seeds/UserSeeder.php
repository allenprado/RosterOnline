<?php

use Illuminate\Database\Seeder;
use \App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

      User::firstOrCreate(['email'=>'allenprado@gmail.com'],
      [
        'name' => 'Allen Prado',
        'password' => Hash::make('123456'),
      ]);

      User::firstOrCreate(['email'=>'allensimoes@gmail.com'],
      [
        'name' => 'Allen Simoes',
        'password' => Hash::make('123456'),
      ]);

      echo "Usuarios Criados! \n";
  }
}
