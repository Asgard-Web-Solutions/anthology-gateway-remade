<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Repositories\UserRepositoryInterface;

class MobileNavMenu extends Component
{
    public $isOpen = false;

    protected $userRepository;

    public $authUser;

    public function mount()
    {
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->authUser = $this->userRepository->getuser(auth()->user()->id);
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
