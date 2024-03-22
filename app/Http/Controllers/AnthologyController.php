<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anthology;
use Illuminate\Support\Facades\Gate;
use App\Repositories\AnthologyRepositoryInterface;

class AnthologyController extends Controller
{
    protected $AnthologyRepository;

    public function __construct()
    {
        $this->AnthologyRepository = app(AnthologyRepositoryInterface::class);
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

        return redirect()->route('anthology.manage', $anthology->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function manage($id)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);

        return view('anthology.manage', [
            'anthology' => $anthology,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
