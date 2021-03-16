<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:fetch';

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
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
    
        $data = $response->json();

        foreach($data as $key => $value){
           
   
            Post::create([
                'userId' => $value['userId'],
                'title' => $value['title'],
                'body' => $value['body']

            ]);
      
        }
        return 'done';
    }


 
}
