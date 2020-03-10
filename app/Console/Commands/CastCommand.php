<?php

namespace App\Console\Commands;

use App\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CastCommand extends Command
{

    protected $signature = 'cast:show';
    protected $description = 'Investigate work with casts';

    public function handle()
    {
        Client::truncate();
        $client = Client::create(
            [
                'name' => 'Client #1',
            ]
        );
        $this->output->writeln('Representation of id: ' . $client->_id);
        $client->object_id = '56f94800911dcc276b5723dd';
        $client->save();
        $this->output->writeln('Representation of object_id: ' . $client->object_id);

    }
}
