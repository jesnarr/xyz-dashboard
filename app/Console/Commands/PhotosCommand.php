<?php

namespace App\Console\Commands;

use App\Photo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PhotosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:fetch';

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
        $response = Http::get('https://jsonplaceholder.typicode.com/photos');
    
        $data = $response->json();


        foreach($data as $key => $value){
           
            
            Photo::create([
                'albumId' => $value['albumId'],
                'title' => $value['title'],
                'url' => $value['url'],
                'thumbnailUrl' => $value['thumbnailUrl']

            ]);
      
        }
    }
}
