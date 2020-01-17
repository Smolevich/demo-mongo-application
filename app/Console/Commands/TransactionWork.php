<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\WriteConcern;
use MongoDB\Driver\Session;
use MongoDB\Driver\ReadConcern;
use MongoDB\Driver\ReadPreference;
use Throwable;

class TransactionWork extends Command
{
    protected $signature = 'transaction:work';
    protected $description = 'demo for transactions';

    public function handle()
    {
        $dbName = 'application';
        $collection = 'transaction_collection';
        $collectionTwo = 'transaction_collection_2';

        try {
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
            // Step 1: Define the callback that specifies the sequence of operations to perform inside the transactions.

            $callback = function (Session $session) use ($client, $dbName, $collection, $collectionTwo) {
                $client
                    ->selectCollection($dbName, $collection)
                    ->insertOne(['abc' => 1], ['session' => $session]);

                $client
                    ->selectCollection($dbName, 'bar')
                    ->insertOne(['xyz' => 999], ['session' => $session]);
            };

            // Step 2: Start a client session.

            $session = $client->startSession();

            // Step 3: Use with_transaction to start a transaction, execute the callback, and commit (or abort on error).

            $transactionOptions = [
                'readConcern' => new ReadConcern(ReadConcern::LOCAL),
                'writeConcern' => new WriteConcern(WriteConcern::MAJORITY, 1000),
                'readPreference' => new ReadPreference(ReadPreference::RP_PRIMARY),
            ];

            \MongoDB\with_transaction($session, $callback, $transactionOptions);
        }  catch (Throwable $t) {
            echo sprintf('Error %s in file %s on line %s', $t->getMessage(), $t->getFile(), $t->getLine()).PHP_EOL;
        }
    }
}
