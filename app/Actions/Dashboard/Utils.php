<?php

namespace App\Actions\Dashboard;

use Carbon\Carbon;

trait Utils
{
    public function greetingByHour()
    {
        $hour = Carbon::now()->hour;

        if ($hour > 12) {
            return 'Good Afternoon';
        } else if ($hour > 18) {
            return 'Good Evening';
        } else {
            return 'Good Morning';
        }
    }
}
