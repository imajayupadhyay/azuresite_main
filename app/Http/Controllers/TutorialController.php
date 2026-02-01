<?php

namespace App\Http\Controllers;

use App\Services\TutorialDataService;
use Inertia\Inertia;
use Inertia\Response;

class TutorialController extends Controller
{
    /**
     * Display the tutorials index page.
     */
    public function index(): Response
    {
        return Inertia::render('Tutorials/Index');
    }

    /**
     * Display a specific tutorial.
     */
    public function show(string $slug): Response
    {
        $service = TutorialDataService::find($slug);

        if (!$service) {
            abort(404);
        }

        return Inertia::render('Tutorials/Show', [
            'service' => $service,
        ]);
    }
}
