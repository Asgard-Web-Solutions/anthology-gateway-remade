<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Repositories\SocialRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

    public function store(Request $request)
    {
        Gate::authorize('create', Social::class);

        Social::create($request->all());
        $this->socialRepository->clearCache();

        return redirect()->route('socials')->with('Social Media added successfully');
    }

    public function edit($id)
    {
        $social = $this->socialRepository->getSocial($id);

        Gate::authorize('update', $social);

        return view('socials.edit')->with([
            'social' => $social,
        ]);
    }

    public function update(Request $request, $id)
    {
        $social = $this->socialRepository->getSocial($id);

        Gate::authorize('update', $social);

        $update['name'] = $request->name;
        $update['image'] = $request->image;
        $update['base_url'] = $request->base_url;

        $this->socialRepository->updateSocial($id, $update);

        return redirect()->route('socials')->with('success', 'Social Media post updated successfully');
    }
}
