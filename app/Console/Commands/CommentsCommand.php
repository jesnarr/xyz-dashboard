<?php

namespace App\Console\Commands;

use App\Comment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CommentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comments:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/comments');
    
        $data = $response->json();

        foreach($data as $key => $value){
           
            Comment::create([
                'postId' => $value['postId'],
                'name' => $value['name'],
                'email' => $value['email'],
                'body' => $value['body']

            ]);
      
        }
    }
}
