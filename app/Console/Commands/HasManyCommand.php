<?php

namespace App\Console\Commands;

use App\Comment;
use App\Merchant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class HasManyCommand extends Command
{

    protected $signature = 'check:hasmany';
    protected $description = 'Check work with relation HasMany ';
    public function handle()
    {
        DB::enableQueryLog();
        Merchant::truncate();
        Comment::truncate();

        $post = Merchant::create(
            [
                'title' => 'Blacksmith Scene',
                'rated' => 'Unrated',
                'year' => 1893,
                'country' => 'USA'
            ]
        );
        Comment::create(['title' => 'Comment #1', 'author' => 'Author #1', 'post_id' => $post->getAttributes()['_id']]);
        dd($post->comments, DB::getQueryLog());
    }
}
