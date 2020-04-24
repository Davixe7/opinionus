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
        // $this->call(UserSeeder::class);
    }
}
