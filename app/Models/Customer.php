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

    public function package(){
        return $this->belongsTo(Package::class);
    }
    public function user_customer(){
        return $this->belongsToMany(User::class);
    }
    public function rating(){
        return $this->belongsTo(Rating::class);
    }
    
}
