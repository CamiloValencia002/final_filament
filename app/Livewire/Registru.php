<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Registru extends Component
{

    public $name;
    public $last_name;
    public $email;
    public $password;
    public $telephone;
    public $address;
    public $document;
    public $document_verify = false;
    public $role;
    public $ratings;
    public $image;
    public $id_admin;

    protected $rules = [
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'telephone' => 'required|string|max:15',
        'adress' => 'required|string|max:255',
        'document' => 'required|string|unique:users,document',
        'role' => 'required|string',
        'ratings' => 'required|numeric|min:0|max:5',
        // 'image' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function register()
    {
        // $this->validate();

        // $imagePath = null;
        // if ($this->image) {
        //     $imagePath = $this->image->store('images', 'public');
        // }

        // Lógica de registro del usuario
        Customer::create([
            'id_admin' => 1,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'telephone' => $this->telephone,
            'adress' => $this->address,
            'document' => $this->document,
            'document_verify' => $this->document_verify,
            'role' => $this->role,
            'ratings' => $this->ratings,     
            // 'image' => $imagePath,
        ]);

        session()->flash('message', 'Registro exitoso.');
        return redirect()->route('login-user');
    }
    public function render()
    {
        return view('livewire.registru');
    }
}
