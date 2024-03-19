<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\PublisherRepositoryInterface;
use App\Repositories\SocialRepositoryInterface;

class PublisherController extends Controller
{
    protected $PublisherRepository;
    protected $SocialRepository;

    public function __construct()
    {
        $this->PublisherRepository = app(PublisherRepositoryInterface::class);
        $this->SocialRepository = app(SocialRepositoryInterface::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function info()
    {
        Gate::authorize('create', Publisher::class);

        return view('publisher.create-info');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Publisher::class);

        return view('publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Publisher::class);

        $publisher = new Publisher;

        $publisher->name = $request->name;
        $publisher->description = $request->description;
        $publisher->logo_url = $request->logo_url;
        $publisher->creator = auth()->user()->id;

        $publisher->save();

        // ADd the user to the teams table
        $publisher->users()->attach(auth()->user()->id, ['role' => 'Owner']);

        return redirect()->route('publisher', $publisher->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publisher = $this->PublisherRepository->getPublisher($id);
        Gate::authorize('view', $publisher);

        return view('publisher.view', [
            'publisher' => $publisher,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publisher = $this->PublisherRepository->getPublisher($id);
        Gate::authorize('update', $publisher);

        return view('publisher.edit')->with([
            'publisher' => $publisher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publisher = $this->PublisherRepository->getPublisher($id);
        Gate::authorize('update', $publisher);

        $publisher->update($request->all());

        return redirect()->route('publisher.view', $publisher->id);
    }

    public function socials($id) {
        $publisher = $this->PublisherRepository->getPublisher($id);
        Gate::authorize('update', $publisher);

        $socials = $this->SocialRepository->getAllSocials();

        return view('publisher.socials')->with([
            'publisher' => $publisher,
            'socials' => $socials
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
