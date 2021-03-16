<?php

namespace App\Console\Commands;

use App\Todo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TodoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:fetch';

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
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');
    
        $data = $response->json();

       
        foreach($data as $key => $value){

           
            Todo::create([
                'userId' => $value['userId'],
                'title' => $value['title'],
                'completed' => $value['completed'],

            ]);
      
        }
       
    }
}
