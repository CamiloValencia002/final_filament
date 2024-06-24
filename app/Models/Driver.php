<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;

class Driver extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'telephone', 'adress',
        'document', 'document_verify', 'photo_licence', 'role', 'image',
        'ratings', 'id_admin'
        // Añade aquí otros campos que quieras que sean asignables masivamente
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'driver';
    }

    
    public function vehicule() {
        return $this->belongsTo(Vehicle::class, 'id_vehicle');
    }
    public function rating(){
        return $this->belongsToMany(Rating::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function user(){ //LO COLOQUE COMO "driver" y le quite el many
        return $this->belongsTo(User::class, 'id_admin');
    }
    public function route(){
        return $this->belongsToMany(Route::class);
    }


}
    
    