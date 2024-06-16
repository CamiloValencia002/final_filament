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
        return $this->belongsTo(Route::class, 'id_route');
    }

    public function driver(){
        return $this->belongsTo(Driver::class, 'id_driver');
    }
    
    public function customers(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
