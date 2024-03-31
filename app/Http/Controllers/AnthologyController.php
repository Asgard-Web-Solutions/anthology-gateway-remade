<?php

namespace App\Http\Controllers;

use App\Models\Anthology;
use App\Repositories\AnthologyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Enums\AnthologyStatus;

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
        Gate::authorize('viewAny', Anthology::class);

        $anthologies = $this->AnthologyRepository->getAllAnthologies();

        return view('anthology.index', [
            'anthologies' => $anthologies,
        ]);
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

        $anthology->creator_id = auth()->user()->id;
        $anthology->status = AnthologyStatus::Draft;
        $anthology->save();

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

        $anthology->header = $this->AnthologyRepository->getAnthologyHeader($id);
        $anthology->cover = $this->AnthologyRepository->getAnthologyCover($id);

        return view('anthology.view', [
            'anthology' => $anthology,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
