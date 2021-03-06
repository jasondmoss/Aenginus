<?php

/**
 * Ænginus: Laravel Website Engine.
 *
 * @package    Laravel
 * @author     Jason D. Moss <jason@jdmlabs.com>
 * @copyright  2017 Jason D. Moss. All rights freely given.
 * @license    https://github.com/jasondmoss/aenginus/blob/master/LICENSE.md [WTFPL License]
 * @link       https://github.com/jasondmoss/aenginus/
 */

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Kernel.
 *
 */
class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];


    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule  $schedule
     *
     * @return void
     * @access protected
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }


    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     * @access protected
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

/* <> */
