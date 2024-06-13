<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];
    public function vehicule() {
        return $this->belongsTo(Vehicle::class);
    }
    public function rating(){
        return $this->belongsTo(Rating::class);
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function route(){
        return $this->belongsTo(Route::class);
    }
}
