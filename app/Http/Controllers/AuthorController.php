<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class AuthorController extends Controller
{

    protected $UserRepository;
    protected $AuthorRepository;

    public function __construct()
    {
        $this->UserRepository = app(UserRepositoryInterface::class);
        $this->AuthorRepository = app(AuthorRepositoryInterface::class);
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
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = new Author($request->all());

        $author->user_id = auth()->user()->id;
        $author->save();

        $this->UserRepository->updateUser(auth()->user()->id, [ 'author_id' => $author->id ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('author.view', [
            'author' => $author,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        Gate::authorize('update', $author);

        return view('author.edit', [
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        Gate::authorize('update', $author);

        $this->AuthorRepository->updateAuthor($author->id, $request->all());

        return redirect()->route('dashboard')->with(['success' => 'Author profile updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
