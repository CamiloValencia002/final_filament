<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id_admin', 'name', 'last_name', 'email', 'password', 'telephone', 'adress', 
        'document', 'document_verify', 'role', 'ratings', 'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'document_verify' => 'boolean',
    ];

    // Relaciones
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    public function rating()
    {
        return $this->belongsToMany(Rating::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }  

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}