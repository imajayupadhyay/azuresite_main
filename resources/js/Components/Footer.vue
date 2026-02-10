<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const email = ref('');
const subscribing = ref(false);
const successMessage = ref('');

const subscribeNewsletter = () => {
    if (!email.value) return;
    
    subscribing.value = true;
    successMessage.value = '';

    router.post(route('newsletter.subscribe'), { email: email.value }, {
        preserveScroll: true,
        onSuccess: () => {
            email.value = '';
            successMessage.value = 'Thank you for subscribing!';
            
            // Hide success message after 5 seconds
            setTimeout(() => {
                successMessage.value = '';
            }, 5000);
        },
        onFinish: () => {
            subscribing.value = false;
        }
    });
};

const footerLinks = {
    learn: [
        { name: 'Tutorials', href: '/tutorials' },
        { name: 'Azure Services', href: '/#services' },
        { name: 'Certifications', href: '/#certifications' },
        { name: 'Learning Paths', href: '/learning-paths' }
    ],
    support: [
        { name: 'Help Center', href: '/support' },
        { name: 'Documentation', href: '/docs' },
        { name: 'Community', href: '/community' },
        { name: 'Contact Us', href: '/contact' }
    ],
    company: [
        { name: 'About Us', href: '/about' },
        { name: 'Blog', href: '/blog' },
        { name: 'Careers', href: '/careers' },
        { name: 'Partners', href: '/partners' }
    ],
    legal: [
        { name: 'Privacy Policy', href: '/privacy' },
        { name: 'Terms of Service', href: '/terms' },
        { name: 'Cookie Policy', href: '/cookies' },
        { name: 'Disclaimer', href: '/disclaimer' }
    ]
};

const socialLinks = [
    { name: 'Twitter', icon: 'M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z', href: 'https://twitter.com' },
    { name: 'LinkedIn', icon: 'M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z M4 6a2 2 0 100-4 2 2 0 000 4z', href: 'https://linkedin.com' },
    { name: 'GitHub', icon: 'M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22', href: 'https://github.com' },
    { name: 'YouTube', icon: 'M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z M9.75 15.02l0-6.89 5.75 3.44z', href: 'https://youtube.com' }
];
</script>

<template>
    <footer class="relative bg-gradient-to-br from-navy-900 via-navy-800 to-primary-900 text-white overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 overflow-hidden opacity-10 pointer-events-none">
            <svg class="absolute top-0 right-0 w-96 h-96" viewBox="0 0 200 200">
                <circle cx="100" cy="100" r="80" stroke="currentColor" stroke-width="0.5" fill="none"/>
                <circle cx="100" cy="100" r="60" stroke="currentColor" stroke-width="0.5" fill="none"/>
                <circle cx="100" cy="100" r="40" stroke="currentColor" stroke-width="0.5" fill="none"/>
            </svg>
            <svg class="absolute bottom-0 left-0 w-64 h-64" viewBox="0 0 200 200">
                <path d="M140 110c15 0 27-12 27-27 0-13-9-24-22-26-2-26-24-47-50-47-18 0-35 10-43 25-4-2-8-2-13-2-19 0-35 15-35 35 0 3 1 6 1 9C8 79 1 91 1 104c0 17 14 31 31 31h108z" fill="currentColor"/>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Newsletter Section -->
            <div class="py-12 border-b border-white/10">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-3xl font-bold mb-2">Stay Updated</h3>
                        <p class="text-primary-200">Get the latest Azure tutorials, tips, and certification guides delivered to your inbox.</p>
                    </div>
                    <div>
                        <!-- Success Message -->
                        <div v-if="successMessage" class="mb-3 bg-green-500/20 border border-green-500/50 rounded-xl px-4 py-3 backdrop-blur-lg">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-green-100 font-medium text-sm">{{ successMessage }}</p>
                            </div>
                        </div>

                        <form @submit.prevent="subscribeNewsletter" class="flex gap-3">
                            <input 
                                v-model="email"
                                type="email" 
                                placeholder="Enter your email" 
                                required
                                :disabled="subscribing"
                                class="flex-1 px-5 py-3 bg-white/10 backdrop-blur-lg border-2 border-white/20 rounded-xl text-white placeholder-white/60 focus:border-primary-400 focus:ring-2 focus:ring-primary-400/50 outline-none transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                            />
                            <button 
                                type="submit"
                                :disabled="subscribing"
                                class="px-8 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-400 hover:to-primary-500 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 flex items-center"
                            >
                                <svg v-if="subscribing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ subscribing ? 'Subscribing...' : 'Subscribe' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Footer Content -->
            <div class="py-12 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                <!-- Logo & Description -->
                <div class="col-span-2">
                    <a href="/" class="flex items-center mb-4 group">
                        <img
                            src="/Azureskill.png"
                            alt="AzureSkill"
                            class="h-10 w-auto transition-all duration-300 group-hover:scale-105 brightness-0 invert"
                        />
                    </a>
                    <p class="text-sm text-gray-300 mb-4 leading-relaxed">
                        Master Azure with hands-on tutorials, comprehensive guides, and expert certification preparation. Your journey to cloud excellence starts here.
                    </p>
                    <!-- Social Links -->
                    <div class="flex space-x-3">
                        <a 
                            v-for="social in socialLinks"
                            :key="social.name"
                            :href="social.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 backdrop-blur-lg hover:bg-white/20 rounded-lg flex items-center justify-center transition-all duration-300 hover:scale-110 border border-white/10 hover:border-primary-400"
                            :aria-label="social.name"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" :d="social.icon"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Learn Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Learn</h4>
                    <ul class="space-y-2">
                        <li v-for="link in footerLinks.learn" :key="link.name">
                            <a :href="link.href" class="text-gray-300 hover:text-primary-300 transition-colors text-sm">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Support Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li v-for="link in footerLinks.support" :key="link.name">
                            <a :href="link.href" class="text-gray-300 hover:text-primary-300 transition-colors text-sm">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Company Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li v-for="link in footerLinks.company" :key="link.name">
                            <a :href="link.href" class="text-gray-300 hover:text-primary-300 transition-colors text-sm">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Legal Links -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li v-for="link in footerLinks.legal" :key="link.name">
                            <a :href="link.href" class="text-gray-300 hover:text-primary-300 transition-colors text-sm">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="py-6 border-t border-white/10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-400">
                        © {{ new Date().getFullYear() }} AzureSkill. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-6 text-sm text-gray-400">
                        <span>Made with ❤️ for Azure learners</span>
                        <span>•</span>
                        <span>Not affiliated with Microsoft</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
