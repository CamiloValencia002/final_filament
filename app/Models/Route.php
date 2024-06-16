<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];
    public function rating() {
        return $this->belongsTo(Rating::class, 'id_route');
        
    }
    public function package() {
        return $this->belongsTo(Package::class, 'id_package');
    }
    public function driver() {
        return $this->belongsTo(Driver::class, 'id_driver');
    }
 
 
}
