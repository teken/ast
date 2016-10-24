<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'firstname' => 'Duncan',
          'lastname' => 'Haig',
          'email' => 'm2010336@tees.ac.uk',
          'password' => bcrypt('password'),
          'administrator' => false
      ]);
      DB::table('users')->insert([
          'firstname' => 'Admin',
          'lastname' => 'Admin',
          'email' => 'admin@admin.com',
          'password' => bcrypt('password'),
          'administrator' => true
      ]);
    }
}
