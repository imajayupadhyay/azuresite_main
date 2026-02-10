<?php

namespace Database\Seeders;

use App\Models\SupportPageSection;
use Illuminate\Database\Seeder;

class SupportPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hero Section
        SupportPageSection::create([
            'section_type' => 'hero',
            'title' => 'How can we <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">help</span>?',
            'subtitle' => 'Get in touch with our team or explore our resources',
            'data' => [
                'response_time' => 'We typically respond within 24 hours'
            ],
            'sort_order' => 0,
            'is_active' => true,
        ]);

        // Quick Links
        $quickLinks = [
            [
                'title' => 'Tutorials',
                'description' => 'Browse learning resources',
                'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'link_url' => '/tutorials',
                'sort_order' => 1,
            ],
            [
                'title' => 'Certifications',
                'description' => 'Exam preparation guides',
                'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                'link_url' => '/certifications',
                'sort_order' => 2,
            ],
            [
                'title' => 'Live Training',
                'description' => 'Join expert sessions',
                'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z',
                'link_url' => '/live-training',
                'sort_order' => 3,
            ],
        ];

        foreach ($quickLinks as $link) {
            SupportPageSection::create([
                'section_type' => 'quick_link',
                'title' => $link['title'],
                'description' => $link['description'],
                'icon' => $link['icon'],
                'link_url' => $link['link_url'],
                'sort_order' => $link['sort_order'],
                'is_active' => true,
            ]);
        }

        // Contact Info
        $contactInfo = [
            [
                'title' => 'Email',
                'description' => 'support@azureskill.com',
                'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                'link_url' => 'mailto:support@azureskill.com',
                'sort_order' => 4,
            ],
            [
                'title' => 'Twitter',
                'description' => '@AzureSkill',
                'icon' => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z',
                'link_url' => 'https://twitter.com/AzureSkill',
                'sort_order' => 5,
            ],
            [
                'title' => 'Response Time',
                'description' => 'Within 24 hours',
                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                'sort_order' => 6,
            ],
        ];

        foreach ($contactInfo as $info) {
            SupportPageSection::create([
                'section_type' => 'contact_info',
                'title' => $info['title'],
                'description' => $info['description'],
                'icon' => $info['icon'],
                'link_url' => $info['link_url'] ?? null,
                'sort_order' => $info['sort_order'],
                'is_active' => true,
            ]);
        }

        // FAQs
        $faqs = [
            [
                'title' => 'How do I access Azure tutorials?',
                'description' => 'Navigate to the Tutorials page from the menu. All tutorials are free with step-by-step instructions.',
                'sort_order' => 7,
            ],
            [
                'title' => 'Do I need an Azure account?',
                'description' => 'You can browse tutorials without an account, but need an Azure subscription for hands-on practice.',
                'sort_order' => 8,
            ],
            [
                'title' => 'Are tutorials updated regularly?',
                'description' => 'Yes! We continuously update content to reflect the latest Azure features. New tutorials added weekly.',
                'sort_order' => 9,
            ],
            [
                'title' => 'How can I get personalized support?',
                'description' => 'Fill out the contact form or email support@azureskill.com. We respond within 24 hours.',
                'sort_order' => 10,
            ],
        ];

        foreach ($faqs as $faq) {
            SupportPageSection::create([
                'section_type' => 'faq',
                'title' => $faq['title'],
                'description' => $faq['description'],
                'sort_order' => $faq['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
