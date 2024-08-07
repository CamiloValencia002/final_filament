<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Logu extends Component
{
    public $email;
    public $password;
    public $userName;

    public function mount()
    {
        if (Auth::check()) {
            $this->userName = Auth::user()->name;
        }
    }
    public function login()
    {
        Log::info('Método login ejecutado');

        $this->validate([
            'email' => 'required|email',    
            'password' => 'required|min:8',
        ]);
        Log::info('Datos validados', ['email' => $this->email, 'password' => $this->password]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            Log::info('Autenticación exitosa', ['email' => $this->email]);
            session()->put('user_id', Auth::id());
            $this->userName = Auth::user()->name;
            session()->put('user_id', Auth::id());
            return redirect()->to('inicioUser');
        } else {
            Log::warning('Autenticación fallida', ['email' => $this->email]);
            session()->flash('error', 'Credenciales incorrectas.');
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->userName = null;
        return redirect()->to('login');
    }

    public function render()
    {
        return view('livewire.logu');
    }
}