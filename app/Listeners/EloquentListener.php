<?php

namespace App\Listeners;

use App\ActivityLogs;

class EloquentListener {

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle($event, $data)
    {
        $disableFire = [
            'ActivityLogs'
        ];

        $continue = true;
        foreach ($disableFire as $item) {
            $continue = strstr($event, $item) ? false : true;
        }

        if ($continue) {
            ActivityLogs::create([
                'fire_event' => $event,
                'user_id' => auth()->id(),
                'site_id' => auth()->user()->site_id
            ]);
        }

        return true;

    }
}
