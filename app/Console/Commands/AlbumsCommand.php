<?php

namespace App\Console\Commands;

use App\Album;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AlbumsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'albums:fetch';

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
        $response = Http::get('https://jsonplaceholder.typicode.com/albums');
    
        $data = $response->json();

        foreach($data as $key => $value){
           
           
            Album::create([
                'userId' => $value['userId'],
                'title' => $value['title'],

            ]);
      
        }

    }
}
