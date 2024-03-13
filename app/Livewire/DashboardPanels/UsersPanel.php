<?php

namespace App\Livewire\DashboardPanels;

use Livewire\Component;
use App\Repositories\UserRepositoryInterface;

class UsersPanel extends Component
{
    public $totalUsers;
    public $newUsers;
    protected $userRepository;

    public function mount()
    {
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->totalUsers = $this->userRepository->countAll();
        $this->newUsers = $this->userRepository->countNew();
    }

    public function render()
    {
        return view('livewire.dashboardPanels.users-dashboard-panel');
    }
}
