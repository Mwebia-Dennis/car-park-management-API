<?php

namespace App\Http\Controllers\CarPark;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarPark;

class CarParkController extends Controller
{
    public function index()
    {
        
        $park = new CarPark();
        if(request()->has('sort_by')) {
            $park = $park->orderBy(request()->sort_by, 'DESC');
        }
        
        $perPage = (request()->has('per_page'))?request()->per_page:env('PER_PAGE');
        return response()->json($park->paginate($perPage));
    }

    public function show($park_id)
    {
        return response()->json(CarPark::find($park_id), 201);
    }
}
