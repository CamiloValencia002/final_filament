<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function rating()
{
    return $this->hasOne(Rating::class, 'id_package');
}
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function route()
    {
        return $this->belongsToMany(Route::class);
    }
}
