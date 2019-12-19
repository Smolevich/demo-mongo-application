<?php

namespace App\Console\Commands;

use App\ProductModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Throwable;

class GeoIndex extends Command
{
    protected $signature = 'geo:index';
    protected $description = 'Check query with regexp';

    public function handle()
    {
        $latitudes = [
            3.12121,
            4.987066,
            8.233233,
            9.232323,
        ];
        $longitudes = [
            7.975414,
            2.221212,
            5.454792,
            2.23433
        ];
        try {
            ProductModel::create(
                [
                    'category_id' => 'test_id',
                    'description' => 'test desciptionr',
                    'location' => [
                        'type' => 'Point',
                        'coordinates' => [
                            $latitudes[array_rand($latitudes, 1)],
                            $longitudes[array_rand($longitudes, 1)],
                        ]
                    ]
                ]
            );
            $lat = '4.987066';
            $long = '7.975414';

            $collection = ProductModel::where('location', 'nearSphere', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float)$lat,
                        (float)$long,
                    ],
                ],
                '$maxDistance' => 30,
            ])->paginate(7);

            foreach ($collection as $elem) {
                $this->output->writeln('Id of elem: '  .$elem->getIdAttribute());
            }

        } catch (Throwable $t) {
            $queries = DB::getQueryLog();
            dd($t);
        }
    }
}
