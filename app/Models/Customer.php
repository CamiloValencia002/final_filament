<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;


class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_admin','name', 'last_name', 'email', 'password', 'telephone', 'adress', 'document', 'document_verify', 'role', 'ratings', 'image'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
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
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
