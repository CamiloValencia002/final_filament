<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

 
    
    
    public function vehicule() {
        return $this->belongsTo(Vehicle::class, 'id_vehicle');
    }
    public function rating(){
        return $this->belongsToMany(Rating::class);
    }
    public function user(){ //LO COLOQUE COMO "driver" y le quite el many
        return $this->belongsTo(User::class, 'id_admin');
    }
    public function route(){
        return $this->belongsToMany(Route::class);
    }
}
