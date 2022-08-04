<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Province;
use GuzzleHttp\Client as GuzzleClient;

class FetchProvinces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:provinces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update provinces to database';

    private function fetchProvince($data) {
        $d = (array)$data;
        $d_id = (array)$data->province_id;

        try {
            $prov = Province::findOrFail($d_id);
            Province::where('province_id', $d_id)->update($d);
        } catch (\Exception $e) {
            $p = Province::create($d);
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
        
        $r = $client->request('GET', 'https://api.rajaongkir.com/starter/province');
        $response = json_decode($r->getBody()->getContents());

        // add data to database
        $result = $response->rajaongkir->results;
        foreach ($result as $res) {
            $this->fetchProvince($res);
        }

        $this->info('Provinces Fetch Complete');
    }
}
