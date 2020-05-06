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
          $banners = Banner::where('is_active', 1)->get();
          if($banners && ($count = $banners->count())){
            for ($i=0; $i < $count; $i++) {
              if( $banners[$i]->is_active ){
                $banner = $banners[$i];
                $expireDate = $banner->updated_at->toDate()->add( new \DateInterval('PT' . $banner->duration . 'S') );
                $now = new \DateTime();
                if( ( $now->getTimestamp() - $expireDate->getTimestamp()) > 0 ){
                  $banner->update(['is_active'=>0]);
                  if( $i < ($count - 1) ){
                    $banners[$i+1]->update(['is_active'=>1]);
                    return;
                  }
                  $banners[0]->update(['is_active'=>1]);
                }
              }
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
