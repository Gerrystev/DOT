<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function getCitiesById(Request $request) 
    {
        $id = $request->id;
        
        try {
            $data = City::findOrFail($id);

            return response()->json([
                "data" => $data,
                "status" => [
                    "code" => 200,
                    "description" => "OK"
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => [
                    "code" => 404,
                    "description" => "Not Found"
                ]
            ], 404);
        }
    }
}
