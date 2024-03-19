<?php

namespace App\Http\Controllers;

use App\Repositories\SocialRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class HomeController extends Controller
{
    protected $socialRepository;
    protected $userRepository;

    public function __construct()
    {
        $this->socialRepository = app(SocialRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function index()
    {
        $socialsCount = $this->socialRepository->countAllSocials();

        return view('home.settings', [
            'socialsCount' => $socialsCount,
        ]);
    }

    public function dashboard() {

        $user = $this->userRepository->getUser(auth()->user()->id);

        return view('dashboard')->with([
            'user' => $user
        ]); 
    }
}
