<?php

namespace App\Console\Commands;

use App\TestModel;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckRegexp extends Command
{
    protected $signature = 'check:regexp';
    protected $description = 'Check query with regexp';

    public function handle()
    {
        $date= Carbon::now();
        $timestamp = $date->getTimestamp();
        $name = "Test #1 ($timestamp)";

        TestModel::create(
            [
                'name' => $name,
                'field_1' => 'sh',
                'field_2' => 'test'
            ]
        );
        $model = TestModel::where('name', $name)
            ->where('field_1', 'regexp', "/sh/i")
            ->where('field_2', 'test')
            ->first();
        $this->output->writeln('Id attribute '. $model->getIdAttribute());
    }
}
