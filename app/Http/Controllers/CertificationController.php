<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\CertificationCategory;
use Inertia\Inertia;
use Inertia\Response;

class CertificationController extends Controller
{
    /**
     * Display the certifications index page.
     */
    public function index(): Response
    {
        // Fetch all active certifications with their categories
        $certifications = Certification::with('category')
            ->active()
            ->ordered()
            ->get()
            ->map(function ($cert) {
                return [
                    'code' => $cert->code,
                    'name' => $cert->name,
                    'slug' => $cert->slug,
                    'level' => strtolower($cert->category->slug ?? 'foundation'),
                    'description' => $cert->description,
                    'duration' => $cert->duration,
                    'difficulty' => $this->getDifficulty($cert->category->slug ?? 'foundation'),
                    'skills' => $this->extractSkillNames($cert->skills),
                    'examLength' => $cert->exam_duration,
                    'questions' => $cert->questions,
                    'passingScore' => $cert->passing_score,
                ];
            });

        // Fetch all active categories for filtering
        $categories = CertificationCategory::active()
            ->ordered()
            ->get()
            ->map(function ($category) {
                return [
                    'slug' => strtolower($category->slug),
                    'name' => $category->name,
                ];
            });

        return Inertia::render('Certifications/Index', [
            'certifications' => $certifications,
            'categories' => $categories,
        ]);
    }

    /**
     * Display a specific certification.
     */
    public function show(string $slug): Response
    {
        $certification = Certification::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$certification) {
            abort(404);
        }

        return Inertia::render('Certifications/Show', [
            'certification' => [
                'code' => $certification->code,
                'slug' => $certification->slug,
                'name' => $certification->name,
                'level' => $certification->category->name ?? 'Unknown',
                'levelColor' => $certification->level_color,
                'description' => $certification->description,
                'longDescription' => $certification->long_description,
                'duration' => $certification->duration,
                'examDuration' => $certification->exam_duration,
                'questions' => $certification->questions,
                'passingScore' => $certification->passing_score,
                'examCost' => $certification->exam_cost,
                'lastUpdated' => $certification->last_updated,
                'prerequisites' => $certification->prerequisites ?? [],
                'targetAudience' => $certification->target_audience ?? [],
                'modules' => $certification->modules ?? [],
                'skills' => $certification->skills ?? [],
                'resources' => $certification->resources ?? [],
                'faqs' => $certification->faqs ?? [],
            ],
        ]);
    }

    /**
     * Get difficulty level based on category
     */
    private function getDifficulty(string $category): string
    {
        return match(strtolower($category)) {
            'foundation' => 'Beginner',
            'associate' => 'Intermediate',
            'expert' => 'Advanced',
            default => 'Beginner',
        };
    }

    /**
     * Extract skill names from skills array
     */
    private function extractSkillNames(array $skills): array
    {
        return array_map(function ($skill) {
            return $skill['name'] ?? $skill;
        }, $skills);
    }
}
