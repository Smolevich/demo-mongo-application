<?php

namespace App\Console\Commands;

use App\Team;
use Illuminate\Console\Command;

class NestedFields extends Command
{
    protected $signature = 'nested:fields';
    protected $description = 'Create team';

    public function handle()
    {
        Team::truncate();
        $team = new Team();
        $team->fill(
            [
                'name' => 'Liverpool',
                'stadium' => 'Anfield',
                'city' => 'Liverpool',
                'players' => [
                    'goalkeepers' => [
                        [
                            'name' => 'Alisson',
                            'number' => 1,
                            'country' => 'Brazil',
                        ]
                    ],
                    'defenders' => [
                        [
                            'name' => 'Nathaniel Clyne',
                            'number' => 2,
                            'country' => 'England',
                        ],
                    ],
                    'midfielders' => [
                        [
                            'name' => 'Fabinho',
                            'number' => 3,
                            'country' => 'Brazil',
                        ]
                    ],
                    'forwards' => [
                        [
                            'name' => 'Mohamed Salah',
                            'number' => 11,
                            'country' => 'Egypt',
                        ]
                    ]
                ]
            ]
        );
        $team->save();
    }
}
