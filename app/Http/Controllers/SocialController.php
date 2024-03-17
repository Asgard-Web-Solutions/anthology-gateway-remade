<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Social;

class SocialController extends Controller
{
    public function index() 
    {
        Gate::authorize('viewAny', Social::class);

        $socials = Social::all();

        return view('social.index')->with([
            'socials' => $socials,
        ]);
    }
}
