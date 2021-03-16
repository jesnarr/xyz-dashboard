<?php

use App\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
