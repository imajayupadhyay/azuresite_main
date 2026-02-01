<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Compute',
                'slug' => 'compute',
                'icon' => 'compute',
                'description' => 'Virtual machines, containers, serverless, and compute resources',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'icon' => 'storage',
                'description' => 'Blob, file, queue, table storage and data lake solutions',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Networking',
                'slug' => 'networking',
                'icon' => 'networking',
                'description' => 'Virtual networks, load balancers, VPN, CDN, and DNS',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Databases',
                'slug' => 'databases',
                'icon' => 'database',
                'description' => 'SQL, NoSQL, cache, and managed database services',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'AI + Machine Learning',
                'slug' => 'ai-ml',
                'icon' => 'ai',
                'description' => 'Cognitive services, ML studio, OpenAI, and AI solutions',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Security',
                'slug' => 'security',
                'icon' => 'security',
                'description' => 'Identity, key vault, security center, and protection services',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'icon' => 'devops',
                'description' => 'CI/CD pipelines, repos, artifacts, and DevOps tools',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Analytics',
                'slug' => 'analytics',
                'icon' => 'analytics',
                'description' => 'Data analytics, Synapse, Data Factory, and big data',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Integration',
                'slug' => 'integration',
                'icon' => 'integration',
                'description' => 'Logic Apps, Service Bus, Event Grid, and integration services',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Monitoring',
                'slug' => 'monitoring',
                'icon' => 'monitor',
                'description' => 'Application Insights, Monitor, Log Analytics, and observability',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ServiceCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
