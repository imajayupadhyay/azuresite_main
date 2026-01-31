<?php

namespace App\Http\Controllers;

use App\Services\CertificationDataService;
use Inertia\Inertia;
use Inertia\Response;

class CertificationController extends Controller
{
    /**
     * Display the certifications index page.
     */
    public function index(): Response
    {
        return Inertia::render('Certifications/Index');
    }

    /**
     * Display a specific certification.
     */
    public function show(string $slug): Response
    {
        $certification = CertificationDataService::find($slug);

        if (!$certification) {
            abort(404);
        }

        return Inertia::render('Certifications/Show', [
            'certification' => $certification,
        ]);
    }
}
