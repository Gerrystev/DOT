<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function isAuthorized($data)
    {
        if($data->search_city != 1){
            // unauthorized
            throw new HttpException(401, 'Unauthorized');
        }
    }
    
    public function getCitiesById(Request $request) 
    {
        $id = $request->id;
        $credential = $request->user();
        
        $this->isAuthorized($credential);
        
        try {
            $data = City::findOrFail($id);

            return response()->json([
                "data" => $data
            ]);
        } catch (\Exception $e) {
            throw new HttpException(404, 'Not Found');
        }
    }

    public function getCitiesByIdApi(Request $request) 
    {
        $id = $request->id;
        $credential = $request->user();
        
        $this->isAuthorized($credential);
        
        // Get data from request API
        $headers = [
            'key' => \config('rajaongkir.url')
        ];
        
        $client = new GuzzleClient([
            'verify' => false,
            'headers' => $headers
        ]);
        
        $r = $client->request('GET', 'https://api.rajaongkir.com/starter/city?id='.$id);
        $response = json_decode($r->getBody()->getContents());

        $result = $response->rajaongkir->results;
        $res = json_decode(json_encode($result), true);

        if(count($res) < 1) {
            throw new HttpException(404, 'Not Found');
        }

        return response()->json([
            "data" => $data,
        ]);
    }
}
