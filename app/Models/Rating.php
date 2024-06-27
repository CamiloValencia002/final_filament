<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $guarded = [
     'id_driver',
        'id_customer',
        'id_package',
        'ratings',
        'comment',
    ];
    public function package(){
        return $this->belongsTo(Package::class, 'id_package');
    }

    public function driver(){
        return $this->belongsTo(Driver::class, 'id_driver');
    }
    
    public function customers(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
