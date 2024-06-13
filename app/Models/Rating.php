<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];
    public function route(){
        return $this->belongsTo(Route::class);
    }

    public function driver(){
        return $this->belongsToMany(Driver::class);
    }
    
    public function customer(){
        return $this->belongsToMany(Customer::class);
    }
}
