<?php

use App\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
