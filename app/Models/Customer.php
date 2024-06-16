<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function packages(){
        return $this->belongsToMany(Package::class);
    }
    public function rating(){
        return $this->belongsToMany(Rating::class);
    }
    public function user() {
        return $this->belongsTo(User::class, 'id_admin');
    }  
    
}
