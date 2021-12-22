<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPark extends Model
{
    use HasFactory;
    
    protected $table = "CAR_PARK";

    protected $fillable = [
        'park_name',
        'location_name',
        'park_type_id',
        'park_type_desc',
        'capacity_of_park',
        'working_time',
        'county_name',
        'latitude',
        'longitude',
        'user_id',
    ];

    
    protected $with = [
        'addedBy',
    ];

    public function addedBy() {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function getTableName(){
        return $this->table;
    }
}
