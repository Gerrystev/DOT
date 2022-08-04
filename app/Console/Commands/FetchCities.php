<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\City;
use GuzzleHttp\Client as GuzzleClient;

class FetchCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update cities to database';

    private function fetchCities($data) {
        $d = (array)$data;
        $d_id = (array)$data->city_id;

        try {
            $city = City::findOrFail($d_id);
            City::where('city_id', $d_id)->update($d);
        } catch (\Exception $e) {
            $p = City::create($d);
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get data from request API
        $headers = [
            'key' => \config('rajaongkir.url')
        ];
        
        $client = new GuzzleClient([
            'verify' => false,
            'headers' => $headers
        ]);
        
        $r = $client->request('GET', 'https://api.rajaongkir.com/starter/city');
        $response = json_decode($r->getBody()->getContents());

        // add data to database
        $result = $response->rajaongkir->results;
        foreach ($result as $res) {
            $this->fetchCities($res);
        }

        $this->info('Cities Fetch Complete');
    }
}
