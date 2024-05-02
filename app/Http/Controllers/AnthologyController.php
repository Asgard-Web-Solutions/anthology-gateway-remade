<?php

namespace App\Http\Controllers;

use App\Models\Anthology;
use App\Repositories\AnthologyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\PublisherRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Enums\AnthologyStatus;
use AWS\CRT\HTTP\Response;

class AnthologyController extends Controller
{
    protected $AnthologyRepository;

    protected $UserRepository;

    protected $PublisherRepository;

    public function __construct()
    {
        $this->AnthologyRepository = app(AnthologyRepositoryInterface::class);
        $this->UserRepository = app(UserRepositoryInterface::class);
        $this->PublisherRepository = app(PublisherRepositoryInterface::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Anthology::class);

        $anthologies = $this->AnthologyRepository->getAllAnthologies();

        return view('anthology.index', [
            'anthologies' => $anthologies,
        ]);
    }

    public function list()
    {
        Gate::authorize('list', Anthology::class);

        $anthologies = $this->AnthologyRepository->getOpenSoonAnthologies();

        foreach ($anthologies as $anthology)
        {
            $anthology->header = $this->AnthologyRepository->getAnthologyHeader($anthology->id);
            $anthology->cover = $this->AnthologyRepository->getAnthologyCover($anthology->id);    
        }

        return view('anthology.list', [
            'anthologies' => $anthologies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($publisher_id = null)
    {
        Gate::authorize('create', Anthology::class);
        $publisher = null;

        if ($publisher_id) {
            $publisher = $this->PublisherRepository->getPublisher($publisher_id);
            Gate::authorize('update', $publisher);
        }

        return view('anthology.create', [
            'publisher' => $publisher,
        ]);
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

        $anthology->creator_id = auth()->user()->id;
        $anthology->status = AnthologyStatus::Draft;
        $anthology->save();

        $this->UserRepository->clearCache(auth()->user()->id);

        if (isset($request->publisher_id)) {
            $this->PublisherRepository->clearCache($request->publisher_id);
        }

        return redirect()->route('anthology.manage', $anthology->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        // Gate::allows('view', $anthology);

        abort_if(is_null($anthology), 404);

        $anthology->header = $this->AnthologyRepository->getAnthologyHeader($id);
        $anthology->cover = $this->AnthologyRepository->getAnthologyCover($id);

        $bookmarked = $anthology->bookmarks()->where('user_id', auth()->user()->id)->exists();

        return view('anthology.view', [
            'anthology' => $anthology,
            'bookmarked' => $bookmarked,
        ]);
    }

    public function manage($id)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        Gate::authorize('update', $anthology);

        $anthology->header = $this->AnthologyRepository->getAnthologyHeader($id);
        $anthology->cover = $this->AnthologyRepository->getAnthologyCover($id);

        $steps = [
            ['name' => 'Basic Details', 'config' => 'basic', 'status' => $anthology->configured_basic_details],
            ['name' => 'Dates', 'config' => 'dates', 'status' => $anthology->configured_dates],
            ['name' => 'Images', 'config' => 'images', 'status' => $anthology->configured_images],
            ['name' => 'Submission Details', 'config' => 'submissions', 'status' => $anthology->configured_submission_details],
            ['name' => 'Message Text', 'config' => 'messages', 'status' => $anthology->configured_message_text],
            ['name' => 'Payment Details', 'config' => 'payments', 'status' => $anthology->configured_payment_details],
        ];

        return view('anthology.manage', [
            'anthology' => $anthology,
            'steps' => $steps,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, $setting)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        Gate::authorize('update', $anthology);

        $anthology->header = $this->AnthologyRepository->getAnthologyHeader($id);
        $anthology->cover = $this->AnthologyRepository->getAnthologyCover($id);

        $user = $this->UserRepository->getUser(auth()->user()->id);

        return view('anthology.edit', [
            'anthology' => $anthology,
            'setting' => $setting,
            'user' => $user,
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

        switch ($request->setting) {
            case 'basic':
                $anthology->configured_basic_details = 1;
                break;

            case 'dates':
                $anthology->configured_dates = 1;
                break;

            case 'submissions':
                $anthology->configured_submission_details = 1;
                break;

            case 'messages':
                $anthology->configured_message_text = 1;
                break;

            case 'images':
                $anthology->configured_images = 1;
                break;

            case 'payments':
                $anthology->configured_payment_details = 1;
                break;
        }

        if ($request->header_image) {
            $header_image = $request->file('header_image')->store("anthology/{$id}/header", 's3');

            if ($header_image && $anthology->header_image) {
                Storage::disk('s3')->delete($anthology->header_image);
            }

            $anthology->header_image = $header_image;
        }

        if ($request->cover_image) {
            $cover_image = $request->file('cover_image')->store("anthology/{$id}/cover", 's3');

            if ($cover_image && $anthology->cover_image) {
                Storage::disk('s3')->delete($anthology->cover_image);
            }

            $anthology->cover_image = $cover_image;
        }

        if ($anthology->status == AnthologyStatus::Draft && $anthology->isFullyConfigured()) {
            $anthology->status = AnthologyStatus::Prelaunch;
        }

        $anthology->update();

        return redirect()->route('anthology.manage', $anthology->id);
    }

    public function launch(String $id)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        Gate::authorize('update', $anthology);

        if ($anthology->status != AnthologyStatus::Prelaunch) {
            return redirect()->route('anthology.manage', $id)->with('warning', 'Cannot launch project from its current state.');
        }

        return view('anthology.launch', [
            'anthology' => $anthology,
        ]);
    }


    public function launch_confirm(String $id)
    {
        $anthology = $this->AnthologyRepository->getAnthology($id);
        Gate::authorize('update', $anthology);

        if ($anthology->status != AnthologyStatus::Prelaunch) {
            return redirect()->route('anthology.manage', $id)->with('warning', 'Cannot launch project from its current state.');
        }

        $attributes = (['status' => AnthologyStatus::Launched]);
        $this->AnthologyRepository->updateAnthology($id, $attributes);
        $this->AnthologyRepository->clearCache();

        return redirect()->route('anthology.manage', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function bookmark(Request $request)
    {
        $validatedData = $request->validate([
            'anthology_id' => ['required', 'integer', 'exists:anthologies,id'],
        ]);
        
        $anthology = $this->AnthologyRepository->getAnthology($validatedData['anthology_id']);
        Gate::authorize('view', $anthology);

        $user = $this->UserRepository->getUser(auth()->user()->id);

        $user->anthologyBookmarks()->attach($anthology->id);

        return redirect()->route('anthology.view', $anthology->id);
    }

    public function unbookmark(Request $request)
    {
        $validatedData = $request->validate([
            'anthology_id' => ['required', 'integer', 'exists:anthologies,id'],
        ]);
        
        $anthology = $this->AnthologyRepository->getAnthology($validatedData['anthology_id']);
        Gate::authorize('view', $anthology);

        $user = $this->UserRepository->getUser(auth()->user()->id);

        $user->anthologyBookmarks()->detach($anthology->id);

        return redirect()->route('anthology.view', $anthology->id);
    }
}
