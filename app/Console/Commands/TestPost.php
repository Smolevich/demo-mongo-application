<?php

namespace App\Console\Commands;

use App\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TestPost extends Command
{
    protected $signature = 'test:post';
    protected $description = 'Test posts';
    public function handle()
    {
        Post::insert([
            [
                'owner_id' => 1,
                'group_id' => 4,
                'title' => 'Post #1',
                'content' => 'Content of post #1',
                'content' => 'Content of post #1',
                'status' => 'planned',
            ],
            [
                'owner_id' => 2,
                'group_id' => 4,
                'title' => 'Post #2',
                'content' => 'Content of post #2',
                'content' => 'Content of post #2',
                'status' => 'planned',
            ],
            [
                'owner_id' => 1,
                'group_id' => 5,
                'title' => 'Post #3',
                'content' => 'Content of post #3',
                'content' => 'Content of post #3',
                'status' => 'active',
            ]
        ]);

        $firstPlanned = Post::where('status', 'planned')->first();
        $firstPlanned->title = 'Post #1 (updated)';
        $firstPlanned->updated_at = Carbon::now();
        $res = $firstPlanned->save();
        $this->output->writeln('Result: '. (string)$res);
    }
}
