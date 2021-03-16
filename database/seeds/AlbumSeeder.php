<?php

use App\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
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
