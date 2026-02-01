<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Inertia\Inertia;
use Inertia\Response;

class TutorialController extends Controller
{
    /**
     * Display the tutorials index page.
     */
    public function index(): Response
    {
        // Get active categories with their active services
        $categories = ServiceCategory::active()
            ->ordered()
            ->with(['activeServices' => function ($query) {
                $query->select([
                    'id',
                    'service_category_id',
                    'name',
                    'slug',
                    'description',
                    'icon_identifier',
                    'difficulty',
                    'order',
                ]);
            }])
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'icon' => $category->icon,
                    'description' => $category->description,
                    'services' => $category->activeServices->map(function ($service) {
                        return [
                            'id' => $service->id,
                            'name' => $service->name,
                            'slug' => $service->slug,
                            'description' => $service->description,
                            'icon' => $service->icon_identifier,
                            'difficulty' => $service->difficulty,
                            'tutorials' => $service->tutorialSections()->count(),
                        ];
                    }),
                ];
            });

        return Inertia::render('Tutorials/Index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Display a specific tutorial.
     */
    public function show(string $slug): Response
    {
        // Find the service by slug with its tutorial content
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'category',
                'tutorialSections' => function ($query) {
                    $query->where('is_active', true)
                        ->orderBy('order')
                        ->with(['contentBlocks' => function ($q) {
                            $q->where('is_active', true)->orderBy('order');
                        }]);
                }
            ])
            ->first();

        if (!$service) {
            abort(404);
        }

        // Transform the data for the frontend
        $tutorialData = [
            'id' => $service->id,
            'name' => $service->name,
            'slug' => $service->slug,
            'category' => $service->category->name,
            'categorySlug' => $service->category->slug,
            'description' => $service->description,
            'metaTitle' => $service->meta_title,
            'metaDescription' => $service->meta_description,
            'difficulty' => ucfirst($service->difficulty),
            'tutorials' => $service->tutorialSections->count(),
            'videoDuration' => $service->video_duration,
            'iconIdentifier' => $service->icon_identifier,
            'videoThumbnail' => $service->video_thumbnail,
            'videoUrl' => $service->video_url,
            'sections' => $service->tutorialSections->map(function ($section) {
                // Group content blocks by type for easier frontend handling
                $content = '';
                $code = null;
                $codeLanguage = null;
                $tip = null;
                $warning = null;
                $info = null;

                $images = [];

                foreach ($section->contentBlocks as $block) {
                    switch ($block->type) {
                        case 'content':
                            $content .= $block->content;
                            break;
                        case 'code':
                            $code = $block->content;
                            $codeLanguage = $block->code_language;
                            break;
                        case 'tip':
                            $tip = $block->content;
                            break;
                        case 'warning':
                            $warning = $block->content;
                            break;
                        case 'info':
                            $info = $block->content;
                            break;
                        case 'image':
                            $images[] = [
                                'path' => $block->image_path,
                                'alt' => $block->image_alt,
                                'caption' => $block->image_caption,
                            ];
                            break;
                    }
                }

                return [
                    'id' => $section->slug,
                    'title' => $section->title,
                    'content' => $content,
                    'code' => $code,
                    'codeLanguage' => $codeLanguage,
                    'tip' => $tip,
                    'warning' => $warning,
                    'info' => $info,
                    'images' => $images,
                ];
            }),
            'relatedServices' => $this->getRelatedServices($service),
        ];

        return Inertia::render('Tutorials/Show', [
            'service' => $tutorialData,
        ]);
    }

    /**
     * Get related services from the same category
     */
    private function getRelatedServices(Service $service): array
    {
        return Service::where('service_category_id', $service->service_category_id)
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->limit(3)
            ->get()
            ->map(function ($relatedService) {
                return [
                    'name' => $relatedService->name,
                    'slug' => $relatedService->slug,
                    'tutorials' => $relatedService->tutorialSections()->count(),
                ];
            })
            ->toArray();
    }
}
