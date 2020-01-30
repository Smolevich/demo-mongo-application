<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use MongoDB\BSON\UTCDateTime;

class CheckPasswordReset extends Command
{
    protected $signature = 'check:password:reset';
    protected $description = 'Check password reset';

    public function handle()
    {
        try {
            DB::enableQueryLog();
            /** disable throttleing */
            Config::set('auth.passwords.users.throttle', 0);

            /** @var User $user */
            $user = factory(User::class)->create();
            $query = DB::connection()->table(config('auth.passwords.users.table'));

            /** First Try */
            /** send reset link (to log) */
            $response = Password::broker()->sendResetLink([ 'email' => $user->email ]);
            $this->output->writeln('#1 first try should work'. trans($response));

            /** check reset entry */
            $reset = $query->where('email', $user->email)->first();
            $this->output->writeln('reset created at '. json_encode($reset['created_at']));

            /** Second Try */
            $response = Password::broker()->sendResetLink([ 'email' => $user->email ]);
            $this->output->writeln('#2 reset response '. trans($response));
            dd(DB::getQueryLog());
        } catch (\Throwable $t) {
            dd($t);
        }
    }
}
