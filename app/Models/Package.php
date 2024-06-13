<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];
    public function customer(){
        return $this->belongsToMany(Customer::class);
    }
    public function request(){
        return $this->belongsTo(Request::class);
    }
}
