<?php

namespace App\Http\Controllers;

use App\Repositories\SocialRepositoryInterface;

class HomeController extends Controller
{
    protected $socialRepository;

    public function __construct()
    {
        $this->socialRepository = app(SocialRepositoryInterface::class);
    }

    public function index()
    {
        $socialsCount = $this->socialRepository->countAllSocials();

        return view('home.settings', [
            'socialsCount' => $socialsCount,
        ]);
    }
}
