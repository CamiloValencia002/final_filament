<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShowPackageUser extends Component
{
    public $packages;

    public function mount()
    {
        $this->loadPackages();
    }

    public function loadPackages()
    {
        $this->packages = Package::where('id_customer', Auth::id())->get();
    }
    

    public function render(): View
    {
        return view('livewire.show-package-user')
        ->layout('layouts.app');;
    }
}