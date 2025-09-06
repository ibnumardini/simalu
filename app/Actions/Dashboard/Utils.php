<?php

namespace App\Actions\Dashboard;

use Carbon\Carbon;

trait Utils
{
    public function greetingByHour()
    {
        $hour = Carbon::now()->hour;

        if ($hour >= 18) {
            return __('messages.dashboard.greeting.evening');
        } elseif ($hour >= 12) {
            return __('messages.dashboard.greeting.afternoon');
        }

        return __('messages.dashboard.greeting.morning');
    }
}
