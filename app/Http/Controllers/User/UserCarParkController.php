<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarPark;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserCarParkController extends Controller
{

    public function index($id)
    {
        
        // $user = Auth::user();
        $user = User::find($id);

        $parks = $user->myCarParks();
        if(request()->has('sort_by')) {
            $parks = $parks->orderBy(request()->sort_by, 'DESC');
        }
        
        $perPage = (request()->has('per_page'))?request()->per_page:env('PER_PAGE');
        return response()->json($parks->paginate($perPage));
    }
    public function store(Request $request, $user_id)
    {
        
        $request->validate($rules = [
    
            'park_name' => 'required|unique:car_park',
            'latitude' => 'required',
            'longitude' => 'required',
            'location_name' => 'required',
            'park_type_id' => 'required',
            'park_type_desc' => 'required',
            'capacity_of_park' => 'required',
            'working_time' => 'required',
            'county_name' => 'required',

        ]);

        $carPark = new CarPark();
        $user = Auth::user();
        $carPark->park_name = $request->park_name;
        $carPark->latitude = $request->latitude;
        $carPark->longitude = $request->longitude;
        $carPark->location_name = $request->location_name;
        $carPark->park_type_desc = $request->park_type_desc;
        $carPark->park_type_id = $request->park_type_id;
        $carPark->capacity_of_park = $request->capacity_of_park;
        $carPark->working_time = $request->working_time;
        $carPark->county_name = $request->county_name;
        $carPark->user_id = $user->id;
        $carPark->save();
        return response()->json([
            "message" => "Successfully added park",
            "id" => $carPark->id
        ], 201);


    }

    
    public function update(Request $request, $user_id, CarPark $carPark) {

        
        $request->validate($rules = [
    
            'park_name' => 'max:150|unique:car_park',
            'latitude' => 'max:150',
            'longitude' => 'max:150',
            'location_name' => 'max:150',
            'park_type_id' => 'max:150',
            'park_type_desc' => 'max:500',
            'capacity_of_park' => 'max:15000',
            'working_time' => 'max:500',
            'county_name' => 'max:500',

        ]);

        $user = Auth::user();
        $carPark->park_name = $request->has('park_name')?$request->park_name:$carPark->park_name;
        $carPark->latitude = $request->has('latitude')?$request->latitude:$carPark->latitude;
        $carPark->longitude = $request->has('longitude')?$request->longitude:$carPark->longitude;
        $carPark->park_type_id = $request->has('park_type_id')?$request->park_type_id:$carPark->park_type_id;
        $carPark->park_type_desc = $request->has('park_type_desc')?$request->park_type_desc:$carPark->park_type_desc;
        $carPark->location_name = $request->has('location_name')?$request->location_name:$carPark->location_name;
        $carPark->capacity_of_park = $request->has('capacity_of_park')?$request->capacity_of_park:$carPark->capacity_of_park;
        $carPark->working_time = $request->has('working_time')?$request->working_time:$carPark->working_time;
        $carPark->county_name = $request->has('county_name')?$request->county_name:$carPark->county_name;
        $carPark->user_id = $user->id;
        
        if($carPark->isDirty()) {
            
            $carPark->save();

        }

        return response()->json(["message" => "  Successfully updated car park"], 201);
    }

    public function destroy($user_id, $car_park_id) {
        $user = Auth::user();
        $carPark = CarPark::find($car_park_id);
        if($carPark->user_id == $user->id) {
            $carPark->delete();
            return response()->json(["message" => "Park deleted succesfully"], 201);
        }
        return response()->json(["error" => "Sorry, you have no authority to delete this park"], 401);
    }
}
