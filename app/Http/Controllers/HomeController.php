<?php

namespace App\Http\Controllers;

use App\Repositories\AnthologyRepositoryInterface;
use App\Repositories\PublisherRepositoryInterface;
use App\Repositories\SocialRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class HomeController extends Controller
{
    protected $socialRepository;

    protected $userRepository;

    protected $publisherRepository;

    protected $anthologyRepository;

    public function __construct()
    {
        $this->socialRepository = app(SocialRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->publisherRepository = app(PublisherRepositoryInterface::class);
        $this->anthologyRepository = app(AnthologyRepositoryInterface::class);
    }

    public function index()
    {
        $socialsCount = $this->socialRepository->countAllSocials();
        $publisherInfo['new'] = $this->publisherRepository->countNewPublishers();
        $publisherInfo['total'] = $this->publisherRepository->countAllPublishers();

        $anthologyInfo['new'] = $this->anthologyRepository->countNewAnthologies();
        $anthologyInfo['total'] = $this->anthologyRepository->countAllAnthologies();

        return view('home.settings', [
            'socialsCount' => $socialsCount,
            'publisherInfo' => $publisherInfo,
            'anthologyInfo' => $anthologyInfo,
        ]);
    }

    public function dashboard()
    {
        $user = $this->userRepository->getUser(auth()->user()->id);

        return view('dashboard')->with([
            'user' => $user,
        ]);
    }

    public function welcome()
    {
        $user = (auth()) ?? $this->userRepository->getUser(auth()->user()->id);

        return view('welcome')->with([
            'user' => $user,
        ]);
    }
}
