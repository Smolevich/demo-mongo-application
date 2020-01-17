<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\WriteConcern;

class TransactionWork extends Command
{
    protected $signature = 'transaction:work';
    protected $description = 'demo for transactions';

    public function handle()
    {
        $dbName = 'application';
        $collection = 'transaction_collection';

        $client = DB::getMongoClient();
        $client->selectCollection(
            $dbName,
            $collection,
            [
                'writeConcern' => new WriteConcern(WriteConcern::MAJORITY, 1000),
            ]
        )->insertOne(['abc' => 0]);

        $client->selectCollection(
            $dbName,
            $collection,
            [
                'writeConcern' => new WriteConcern(WriteConcern::MAJORITY, 1000),
            ]
        )->insertOne(['xyz' => 0]);
        
        dd($client);
    }
}
