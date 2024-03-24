<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anthology;
use Illuminate\Support\Facades\Gate;
use App\Repositories\AnthologyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class AnthologyController extends Controller
{
    protected $AnthologyRepository;
    protected $UserRepository;

    public function __construct()
    {
        $this->AnthologyRepository = app(AnthologyRepositoryInterface::class);
        $this->UserRepository = app(UserRepositoryInterface::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Anthology::class);

        return view('anthology.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Anthology::class);
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'open_date' => 'required|date|after:today',
        ]);

        $anthology = Anthology::create($request->all());

        $anthology->users()->attach(auth()->user()->id, ['role' => 'Creator']);

        $this->UserRepository->clearCache(auth()->user()->id);

        return redirect()->route('anthology.manage', $anthology->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        Gate::authorize('view', $anthology);

        return view('anthology.view', [
            'anthology' => $anthology,
        ]);
    }

    public function manage($id)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        Gate::authorize('update', $anthology);

        return view('anthology.manage', [
            'anthology' => $anthology,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, $setting)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        Gate::authorize('update', $anthology);

        return view('anthology.edit', [
            'anthology' => $anthology,
            'setting' => $setting,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        Gate::authorize('update', $anthology);

        $this->AnthologyRepository->updateAnthology($id, $request->all());

        return redirect()->route('anthology.manage', $anthology->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
