<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $response = Http::get('https://jsonplaceholder.typicode.com/users');
    
        $data = $response->json();
        foreach($data as $key => $value){
          
            $data = array('name' => $value['company']['name'],'catchPhrase' => $value['company']['catchPhrase'],'bs'=>$value['company']['bs']);
            $data2 = array('street' => $value['address']['street'],'suite' => $value['address']['suite'],'city'=>$value['address']['city'],
            'zipcode'=>$value['address']['zipcode'],'geo'=>array('lat'=>$value['address']['geo']['lat'],'lng'=>$value['address']['geo']['lng']));

            $company = json_encode($data);
            $address = json_encode($data2);
            User::create([
                'name' => $value['name'],
                'username' => $value['username'],
                'email' => $value['email'],
                'phone' => $value['phone'],
                'website' => $value['website'],
                'company' => $company,
                'address' => $address

            ]);
      
        }
    }
}
