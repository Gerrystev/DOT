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
}
