<?php

use App\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
