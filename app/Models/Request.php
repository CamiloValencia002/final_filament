<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];
    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }
}
