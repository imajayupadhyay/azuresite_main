<?php

namespace Database\Seeders;

use App\Models\CertificationCategory;
use Illuminate\Database\Seeder;

class CertificationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Foundation',
                'slug' => 'foundation',
                'icon' => 'academic',
                'description' => 'Entry-level certifications for beginners. Perfect for those starting their Azure journey with fundamentals in cloud concepts, AI, data, and security.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Associate',
                'slug' => 'associate',
                'icon' => 'badge',
                'description' => 'Intermediate certifications for professionals. Validate your skills in administration, development, security, data engineering, AI, and DevOps.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Expert',
                'slug' => 'expert',
                'icon' => 'trophy',
                'description' => 'Advanced certifications for experienced professionals. Demonstrate expertise in solution architecture and cybersecurity leadership.',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            CertificationCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
