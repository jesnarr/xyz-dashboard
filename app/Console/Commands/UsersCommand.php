<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:fetch';

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
