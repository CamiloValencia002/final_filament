<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatePackage extends Component
{
    public $packageId;
    public $rating;
    public $comment;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:255',
    ];

    public function mount($packageId)
    {
        $this->packageId = $packageId;
    }

    public function submitRating()
    {
        $this->validate();

        $rating = Rating::updateOrCreate(
            [
                'id_customer' => Auth::id(),
                'id_package' => $this->packageId,
            ],
            [
                'comment_customer' => $this->comment,
            ]
        );
        
        $rating->rating_customer = $this->rating;
        $rating->save();

        if ($rating) {
            session()->flash('message', 'Calificación enviada con éxito.');
            $this->reset(['rating', 'comment']);
            return redirect()->route('inicioUser');
        } else {
            session()->flash('error', 'Hubo un problema al enviar la calificación.');
        }
    }

    public function render()
    {
        return view('livewire.rate-package');
    }
}