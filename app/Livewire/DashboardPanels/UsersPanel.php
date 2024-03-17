<?php

namespace App\Livewire\DashboardPanels;

use App\Repositories\UserRepositoryInterface;
use Livewire\Component;

class UsersPanel extends Component
{
    public $totalUsers;

    public $newUsers;

    protected $userRepository;

    public function mount()
    {
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->totalUsers = $this->userRepository->countAllUsers();
        $this->newUsers = $this->userRepository->countNewUsers();
    }

    public function render()
    {
        return view('livewire.dashboardPanels.users-dashboard-panel');
    }
}
