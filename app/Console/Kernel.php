<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Banner;

class Kernel extends ConsoleKernel
{
  /**
  * The Artisan commands provided by your application.
  *
  * @var array
  */
  protected $commands = [
    //
  ];
  
  /**
  * Define the application's command schedule.
  *
  * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
  * @return void
  */
  protected function schedule(Schedule $schedule)
  {
    $schedule->call(function(){
      $bannersCount  = Banner::whereEnabled(1)->count();
      if( $bannersCount > 1 ){
        $activeBanner = Banner::whereEnabled(1)->where('is_active', 1)->first();
        if( !$activeBanner ){
          Banner::whereEnabled(1)->first()->update('is_active', 1);
        }
        elseif( $activeBanner->hasExpired ){
          $activeBanner->update(['is_active', 0]);
          $activeBanner->getNextEnabledSibling()->update(['is_active', 1]);
        }
      }
    })->everyMinute();
  }
  
  /**
  * Register the commands for the application.
  *
  * @return void
  */
  protected function commands()
  {
    $this->load(__DIR__.'/Commands');
    
    require base_path('routes/console.php');
  }
}
