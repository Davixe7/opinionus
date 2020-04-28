<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Banner::class, 30)->create();
      
      App\User::create([
        'name'     => 'Admin',
        'email'    => 'root@polly.com',
        'password' => bcrypt('123456')
      ]);
      
        // $this->call(UserSeeder::class);
    }
}
