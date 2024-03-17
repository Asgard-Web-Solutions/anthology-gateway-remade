<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MobileNavMenu extends Component
{
    public $isOpen = false;

    public function toggleNavigation()
    {
        $this->isOpen = ! $this->isOpen;
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.mobile-nav-menu');
    }
}
