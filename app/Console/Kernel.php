<?php

namespace App\Console;

use App\Http\Controllers\CronController;
use App\Lib\General;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            try {
                $cronController = new CronController();
                $cronController->getUpdatePrice();
                //send success mail
                // General::sendSchedularEmail('product_prices','Success',true);
            } catch (\Exception $e) {
                General::sendSchedularEmail('product_prices',$e->getMessage());
            }
        })->name('update:product_prices')
            ->everyOddHour();

        $schedule->call(function () {
            try {
                $cronController = new CronController();
                $cronController->getUpdateMetalRate();
                //send success mail
                // General::sendSchedularEmail('metal_rate','Success',true);
            } catch (\Exception $e) {
                General::sendSchedularEmail('metal_rate',$e->getMessage());   
            }
        })->name('update:metal_rate')
            ->dailyAt('08:00');

        $schedule->call(function () {
            try {
                $cronController = new CronController();
                $cronController->getUpdateUsdRate();
                //send success mail
                // General::sendSchedularEmail('usd_rate','Success',true);
            } catch (\Exception $e) {
                General::sendSchedularEmail('usd_rate',$e->getMessage()); 
            }
        })->name('update:usd_rate')
            ->dailyAt('08:02');

        $schedule->call(function () {
            try {
                $cronController = new CronController();
                $cronController->getParishiDiamond();
                //send success mail
                // General::sendSchedularEmail('parishi_diamond','Success',true);
            } catch (\Exception $e) {
                General::sendSchedularEmail('parishi_diamond',$e->getMessage());  
            }
        })->name('update:parishi_diamond')
            ->dailyAt('08:05');

        $schedule->call(function () {
            try {
                $cronController = new CronController();
                $cronController->getStarraysDiamond();
                //send success mail
                // General::sendSchedularEmail('starrays_diamond','Success',true);
            } catch (\Exception $e) {
                General::sendSchedularEmail('starrays_diamond',$e->getMessage());  
            }
        })->name('update:starrays_diamond')
            ->dailyAt('08:07');

        $schedule->call(function () {
            try {
                $cronController = new CronController();
                $cronController->getSanghviDiamond();
                //send success mail
                // General::sendSchedularEmail('sanghvi_diamond','Success',true); 
            } catch (\Exception $e) {
                General::sendSchedularEmail('sanghvi_diamond',$e->getMessage());  
            }
        })->name('update:sanghvi_diamond')
            ->dailyAt('08:10');

        $schedule->call(function () {
            try {
                $cronController = new CronController();
                $cronController->getAsianStarsDiamond();
                //send success mail
                // General::sendSchedularEmail('asian_stars_diamond','Success',true); 
            } catch (\Exception $e) {
                General::sendSchedularEmail('asian_stars_diamond',$e->getMessage());  
            }
        })->name('update:asian_stars_diamond')
            ->dailyAt('08:15');

        $schedule->call(function () {
            try {
                $cronController = new CronController();
                $cronController->getDharamDiamond();
                //send success mail
                // General::sendSchedularEmail('dharam_diamond','Success',true); 
            } catch (\Exception $e) {
                General::sendSchedularEmail('dharam_diamond',$e->getMessage());  
            }
        })->name('update:dharam_diamond')
            ->dailyAt('08:18');

        $schedule->call(function () {
            try {
                $logPath = storage_path('logs/laravel.log');
                if (file_exists($logPath)) {
                    file_put_contents($logPath, '');
                    Log::info('[clear:logs] Laravel logs cleared successfully.');
                }
                // General::sendSchedularEmail('clear_logs','Success',true); 
            } catch (\Exception $e) {
                General::sendSchedularEmail('clear_logs',$e->getMessage());  
            }
        })->name('clear:logs')->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
