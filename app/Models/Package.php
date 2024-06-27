<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $guarded = [
     
    ];  
    public function customers(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }
    
    public function driver() {
        return $this->belongsTo(Driver::class, 'id_driver');
    }
 

}
