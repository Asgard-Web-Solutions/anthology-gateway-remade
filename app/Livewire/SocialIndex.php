<?php

namespace App\Livewire;

use App\Repositories\SocialRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class SocialIndex extends Component
{
    protected $socialRepository;

    public function mount()
    {
        $this->socialRepository = app(SocialRepositoryInterface::class);
    }

    public function render()
    {
        Gate::authorize('viewAny', Social::class);

        $socials = $this->socialRepository->getAllSocials();

        return view('livewire.social.index', [
            'socials' => $socials,
        ]);
    }
}
