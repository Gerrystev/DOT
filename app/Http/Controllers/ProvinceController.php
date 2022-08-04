<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function getProvinceById(Request $request) 
    {
        $id = $request->id;
        
        try {
            $data = Province::findOrFail($id);

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
