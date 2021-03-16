<?php

use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
    
        $data = $response->json();

        foreach($data as $key => $value){
           
   
            Post::create([
                'userId' => $value['userId'],
                'title' => $value['title'],
                'body' => $value['body']

            ]);
      
        }
    }
}
