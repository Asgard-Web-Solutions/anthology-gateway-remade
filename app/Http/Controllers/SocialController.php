<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Social;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\SocialRepositoryInterface;

class SocialController extends Controller
{
    protected $userRepository;
    protected $socialRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepositoryInterface::class);  
        $this->socialRepository = app(SocialRepositoryInterface::class); 
    }

    public function index() 
    {
        Gate::authorize('viewAny', Social::class);

        $socials = $this->socialRepository->getAllSocials();

        return view('social.index')->with([
            'socials' => $socials,
        ]);
    }

    public function edit($id)
    {
        Gate::authorize('update', Social::class);

        $social = $this->socialRepository->getSocial($id);

        return view('socials.edit')->with([
            'social' => $social
        ]);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('update', Social::class);

        $update['name'] = $request->name;
        $update['image'] = $request->image;
        $update['base_url'] = $request->base_url;

        $this->socialRepository->updateSocial($id, $update);

        return redirect()->route('socials')->with('success', 'Social Media post updated successfully');
    }
}
