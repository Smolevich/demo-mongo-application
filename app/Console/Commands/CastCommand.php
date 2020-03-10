<?php

namespace App\Console\Commands;

use App\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use MongoDB\BSON\ObjectID;

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
        $id = $client->_id;
        $this->output->writeln('Representation of id: ' . $client->_id);
        $client->object_id = new ObjectID('56f94800911dcc276b5723dd');
        // $client->object_id = '56f94800911dcc276b5723dd'; don't saved correctly
        $client->save();
        $this->output->writeln('Representation of object_id: ' . $client->object_id);
        $client = Client::find($id);
        $this->output->writeln('Representation of id: ' . $client->_id);
        dd($client);

    }
}
