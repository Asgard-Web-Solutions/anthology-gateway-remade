<?php

namespace App\Livewire;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MainNavMenu extends Component
{
    protected $userRepository;

    public $authUser;

    public function mount()
    {
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->authUser = $this->userRepository->getuser(auth()->user()->id);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.main-nav-menu');
    }
}
