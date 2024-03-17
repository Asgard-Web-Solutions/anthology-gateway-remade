<?php

namespace App\Livewire;

use App\Models\Social;
use Livewire\Component;
use App\Repositories\SocialRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class SocialEdit extends Component
{
    protected $socialRepository;
    public $social;
    public $id;

    public function mount($id)
    {
        $this->socialRepository = app(SocialRepositoryInterface::class);
        $this->social = $this->socialRepository->getSocial($id);
        $this->id = $id;
    }

    public function save()
    {
        dd('The Save function loaded');

        $this->validate([
            'social.name' => 'required',
        ]);
    
        $social = $this->socialRepository->getSocial($this->socialId);
        $social->update([
            'name' => $this->social->name,
        ]);
    
        return redirect()->route('socials');
    }
    
    public function render()
    {
        return view('livewire.social.edit');
    }
}
