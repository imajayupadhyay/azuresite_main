<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthModal from './AuthModal.vue';

const isMenuOpen = ref(false);
const isAuthModalOpen = ref(false);
const isScrolled = ref(false);
const page = usePage();

const openAuthModal = () => {
    isAuthModalOpen.value = true;
    isMenuOpen.value = false; // Close mobile menu if open
};

const closeAuthModal = () => {
    isAuthModalOpen.value = false;
};

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

const isHomePage = computed(() => {
    return page.url === '/';
});

const isTransparent = computed(() => {
    return isHomePage.value && !isScrolled.value;
});

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

const navigation = [
    { name: 'Home', href: '/' },
    { name: 'Tutorials', href: '/tutorials' },
    { name: 'Live Training', href: '/live-training' },
    { name: 'Certifications', href: '/certifications' },
    { name: 'Support', href: '/support' },
];

const isActive = (href) => {
    const currentUrl = page.url;
    if (href === '/') {
        return currentUrl === '/';
    }
    return currentUrl.startsWith(href);
};
</script>

<template>
    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <!-- Dynamic Header Container -->
        <div 
            class="transition-all duration-300"
            :class="isTransparent 
                ? 'bg-transparent backdrop-blur-md border-b border-white/10' 
                : 'bg-white/90 backdrop-blur-xl shadow-lg shadow-navy-900/5 border-b border-navy-200/50'"
        >
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo with Cloud Design -->
                    <a href="/" class="flex items-center space-x-3 group">
                        <div class="relative w-10 h-10 flex items-center justify-center">
                            <!-- Cloud Logo SVG -->
                            <svg class="w-10 h-10 transition-all duration-300 group-hover:scale-110" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="cloud-gradient" x1="24" y1="10" x2="24" y2="38">
                                        <stop offset="0%" stop-color="#5ea0ef"/>
                                        <stop offset="100%" stop-color="#0078d4"/>
                                    </linearGradient>
                                </defs>
                                <!-- Main Cloud Shape -->
                                <path d="M38.5 28c2.5 0 4.5-2 4.5-4.5 0-2.2-1.6-4-3.7-4.4-.3-4.4-4-7.9-8.5-7.9-3.1 0-5.8 1.6-7.3 4.1-0.7-0.3-1.4-0.4-2.2-0.4-3.2 0-5.8 2.6-5.8 5.8 0 0.5 0.1 1 0.2 1.5C13.2 22.9 11.5 24.9 11.5 27.3c0 2.8 2.3 5.2 5.2 5.2h21.8z" 
                                      fill="url(#cloud-gradient)" 
                                      class="group-hover:opacity-90 transition-opacity"/>
                                <!-- Cloud Highlight -->
                                <path d="M38.5 28c2.5 0 4.5-2 4.5-4.5 0-2.2-1.6-4-3.7-4.4-.3-4.4-4-7.9-8.5-7.9-3.1 0-5.8 1.6-7.3 4.1" 
                                      stroke="#50e6ff" 
                                      stroke-width="1.5" 
                                      stroke-linecap="round"
                                      fill="none"
                                      opacity="0.6"/>
                                <!-- Small Cloud Detail -->
                                <circle cx="26" cy="20" r="1.5" fill="#50e6ff" opacity="0.8"/>
                                <circle cx="32" cy="24" r="1.2" fill="#50e6ff" opacity="0.6"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span 
                                class="text-xl font-bold transition-colors leading-none"
                                :class="isTransparent ? 'text-white group-hover:text-primary-300' : 'text-navy-900 group-hover:text-primary-600'"
                            >
                                AzureSkill
                            </span>
                            <span 
                                class="text-[10px] font-medium tracking-wider uppercase"
                                :class="isTransparent ? 'text-primary-200' : 'text-navy-500'"
                            >
                                Cloud Learning
                            </span>
                        </div>
                    </a>

                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex items-center space-x-1">
                        <a
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            class="px-4 py-2 text-sm font-semibold rounded-lg transition-all duration-300 relative"
                            :class="[
                                isActive(item.href) 
                                    ? (isTransparent ? 'text-white bg-white/10' : 'text-primary-600')
                                    : (isTransparent ? 'text-white/90 hover:text-white hover:bg-white/10' : 'text-navy-600 hover:text-navy-900 hover:bg-navy-50')
                            ]"
                        >
                            {{ item.name }}
                            <div 
                                v-if="isActive(item.href) && !isTransparent"
                                class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-primary-500 to-primary-700 rounded-full"
                            ></div>
                        </a>
                    </nav>

                    <!-- Right Actions -->
                    <div class="hidden lg:flex items-center space-x-4">
                        <!-- Login Button -->
                        <button
                            @click="openAuthModal"
                            class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 rounded-lg transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg shadow-primary-600/30"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Login / Signup
                        </button>
                    </div>

                    <!-- Mobile menu button -->
                    <button
                        @click="isMenuOpen = !isMenuOpen"
                        class="lg:hidden p-2 rounded-lg active:scale-95 transition-all"
                        :class="isTransparent ? 'text-white hover:bg-white/10' : 'text-navy-600 hover:bg-navy-100'"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                v-if="!isMenuOpen"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                v-else
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        <!-- Mobile Menu Overlay -->
        <transition
            enter-active-class="transition-opacity duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div 
                v-show="isMenuOpen" 
                @click="isMenuOpen = false"
                class="fixed inset-0 bg-navy-900/60 backdrop-blur-sm z-40 lg:hidden"
            ></div>
        </transition>

        <!-- Mobile Menu Sidebar -->
        <transition
            enter-active-class="transition-transform duration-300 ease-out"
            enter-from-class="translate-x-full"
            enter-to-class="translate-x-0"
            leave-active-class="transition-transform duration-200 ease-in"
            leave-from-class="translate-x-0"
            leave-to-class="translate-x-full"
        >
            <div 
                v-show="isMenuOpen"
                class="fixed top-0 right-0 bottom-0 w-80 bg-white shadow-2xl z-50 lg:hidden overflow-y-auto"
            >
                <!-- Menu Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <!-- Cloud Logo -->
                        <div class="relative w-10 h-10 flex items-center justify-center">
                            <svg class="w-10 h-10" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="mobile-cloud-gradient" x1="24" y1="10" x2="24" y2="38">
                                        <stop offset="0%" stop-color="#5ea0ef"/>
                                        <stop offset="100%" stop-color="#0078d4"/>
                                    </linearGradient>
                                </defs>
                                <path d="M38.5 28c2.5 0 4.5-2 4.5-4.5 0-2.2-1.6-4-3.7-4.4-.3-4.4-4-7.9-8.5-7.9-3.1 0-5.8 1.6-7.3 4.1-0.7-0.3-1.4-0.4-2.2-0.4-3.2 0-5.8 2.6-5.8 5.8 0 0.5 0.1 1 0.2 1.5C13.2 22.9 11.5 24.9 11.5 27.3c0 2.8 2.3 5.2 5.2 5.2h21.8z" 
                                      fill="url(#mobile-cloud-gradient)"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-xl font-bold text-navy-900">AzureSkill</span>
                            <p class="text-xs text-navy-600">Cloud Learning</p>
                        </div>
                    </div>
                    <button
                        @click="isMenuOpen = false"
                        class="p-2 rounded-lg text-navy-600 hover:bg-gray-100 transition-colors"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="p-6">
                    <nav class="space-y-2">
                        <a
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            @click="isMenuOpen = false"
                            class="group flex items-center justify-between px-4 py-3.5 text-base font-semibold rounded-xl transition-all"
                            :class="isActive(item.href)
                                ? 'bg-gradient-to-r from-primary-50 to-primary-100 text-primary-700 border-2 border-primary-200'
                                : 'text-navy-700 hover:bg-gray-50 border-2 border-transparent'"
                        >
                            <span>{{ item.name }}</span>
                            <svg 
                                class="w-5 h-5 transition-transform"
                                :class="isActive(item.href) ? 'text-primary-600' : 'text-gray-400 group-hover:translate-x-1'"
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </nav>

                    <!-- Login Button -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <button
                            @click="openAuthModal"
                            class="flex items-center justify-center w-full px-6 py-3.5 text-base font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 rounded-xl transition-all shadow-lg"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Login / Signup
                        </button>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-r from-primary-50 to-navy-50 border-t border-gray-200">
                    <p class="text-xs text-navy-600 text-center">
                        © {{ new Date().getFullYear() }} AzureSkill. All rights reserved.
                    </p>
                </div>
            </div>
        </transition>

        <!-- Auth Modal -->
        <AuthModal :is-open="isAuthModalOpen" @close="closeAuthModal" />
    </header>
</template>
