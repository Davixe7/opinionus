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
      // factory(App\Banner::class, 30)->create();
      
      App\Admin::create([
        'name'     => 'Admin',
        'email'    => 'root@polly.com',
        'password' => bcrypt('123456')
      ]);
      
      App\User::create([
        'name'     => 'John Doe',
        'email'    => 'johndoe@polly.com',
        'password' => bcrypt('123456')
      ]);
      
      App\User::create([
        'name'     => 'Jane Doe',
        'email'    => 'janedoe@polly.com',
        'password' => bcrypt('123456')
      ]);
      
        // $this->call(UserSeeder::class);
    }
}
