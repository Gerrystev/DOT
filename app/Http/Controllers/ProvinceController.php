<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function isAuthorized($data)
    {
        if($data->search_province != 1){
            // unauthorized
            throw new HttpException(401, 'Unauthorized');
        }
    }
    
    public function getProvinceById(Request $request) 
    {
        $id = $request->id;
        $credential = $request->user();
        
        $this->isAuthorized($credential);
        
        try {
            $data = Province::findOrFail($id);

            return response()->json([
                "data" => $data,
            ]);
        } catch (\Exception $e) {
            throw new HttpException(404, 'Not Found');
        }
    }
}
