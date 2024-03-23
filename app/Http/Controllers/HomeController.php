<?php

namespace App\Http\Controllers;

use App\Repositories\SocialRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\PublisherRepositoryInterface;

class HomeController extends Controller
{
    protected $socialRepository;
    protected $userRepository;
    protected $publisherRepository;

    public function __construct()
    {
        $this->socialRepository = app(SocialRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->publisherRepository = app(PublisherRepositoryInterface::class);
    }

    public function index()
    {
        $socialsCount = $this->socialRepository->countAllSocials();
        $publisherInfo['new'] = $this->publisherRepository->countNewPublishers();
        $publisherInfo['total'] = $this->publisherRepository->countAllPublishers();


        return view('home.settings', [
            'socialsCount' => $socialsCount,
            'publisherInfo' => $publisherInfo,
        ]);
    }

    public function dashboard() {

        $user = $this->userRepository->getUser(auth()->user()->id);
        
        return view('dashboard')->with([
            'user' => $user
        ]); 
    }
}
