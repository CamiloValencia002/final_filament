<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
<<<<<<< HEAD

    public function route()
    {
        return $this->belongsToMany(Route::class);
    }
=======
    
    public function driver() {
        return $this->belongsTo(Driver::class, 'id_driver');
    }
 

>>>>>>> aab255039f3cedb3a2feca9d7c6ed9ee14007069
}
