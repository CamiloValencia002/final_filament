<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];

    public function package(){
        return $this->belongsTo(Package::class);
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function rating(){
        return $this->belongsTo(Rating::class);
    }
    
}
