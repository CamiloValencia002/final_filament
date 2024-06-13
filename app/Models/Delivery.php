<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];
    public function vehicle(){
        return $this->belongsToMany(Vehicle::class);
    }
    public function rating(){
        return $this->belongsTo(Rating::class);
    }
    public function request(){
        return $this->belongsTo(Request::class);
    }
}
