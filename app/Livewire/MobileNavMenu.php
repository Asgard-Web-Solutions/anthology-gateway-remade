<?php

namespace App\Livewire;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MobileNavMenu extends Component
{
    public $isOpen = false;

    protected $userRepository;

    public $authUser;

    public function mount()
    {
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->authUser = (auth()->check()) ? $this->userRepository->getuser(auth()->user()->id) : null;
    }

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
