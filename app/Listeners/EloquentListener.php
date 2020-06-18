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
            /** @var \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard $auth */
            $auth = auth();
            $user = $auth->user();

            ActivityLogs::create([
                'fire_event' => $event,
                'user_id' => isset($auth) ? $auth->id() : '-1',
                'site_id' => isset($user) ? $user->site_id : '-1'
            ]);
        }

        return true;

    }
}
