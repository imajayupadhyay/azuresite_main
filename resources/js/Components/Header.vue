<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import AuthModal from './AuthModal.vue';
import { useDarkMode } from '@/Composables/useDarkMode.js';

const { isDark, toggleDarkMode } = useDarkMode();

const isMenuOpen = ref(false);
const isAuthModalOpen = ref(false);
const isProfileDropdownOpen = ref(false);
const isScrolled = ref(false);
const page = usePage();

const openAuthModal = () => {
    isAuthModalOpen.value = true;
    isMenuOpen.value = false; // Close mobile menu if open
};

const closeAuthModal = () => {
    isAuthModalOpen.value = false;
};

const toggleProfileDropdown = () => {
    isProfileDropdownOpen.value = !isProfileDropdownOpen.value;
};

const handleLogout = () => {
    if (confirm('Are you sure you want to logout?')) {
        router.post(route('customer.logout'));
    }
};

const customer = computed(() => page.props.customer);

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
                : 'bg-white/90 dark:bg-navy-900/90 backdrop-blur-xl shadow-lg shadow-navy-900/5 dark:shadow-navy-950/20 border-b border-navy-200/50 dark:border-navy-700/50'"
        >
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo with Cloud Design -->
                    <a href="/" class="flex items-center group">
                        <img
                            src="/Azureskill.png"
                            alt="AzureSkill"
                            class="h-10 w-auto transition-all duration-300 group-hover:scale-105"
                            :class="isTransparent || isDark ? 'brightness-0 invert' : ''"
                        />
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
                                    ? (isTransparent ? 'text-white bg-white/10' : 'text-primary-600 dark:text-primary-400')
                                    : (isTransparent ? 'text-white/90 hover:text-white hover:bg-white/10' : 'text-navy-600 dark:text-navy-200 hover:text-navy-900 dark:hover:text-white hover:bg-navy-50 dark:hover:bg-white/10')
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
                        <!-- Dark Mode Toggle -->
                        <button
                            @click="toggleDarkMode"
                            class="relative w-14 h-7 rounded-full transition-all duration-300 focus:outline-none"
                            :class="isTransparent
                                ? 'bg-white/15 hover:bg-white/25'
                                : (isDark ? 'bg-primary-600' : 'bg-navy-200 hover:bg-navy-300')"
                            :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'"
                        >
                            <div
                                class="absolute top-0.5 w-6 h-6 rounded-full flex items-center justify-center transition-all duration-300 shadow-sm"
                                :class="isDark ? 'translate-x-7.5 bg-navy-900' : 'translate-x-0.5 bg-white'"
                            >
                                <!-- Sun icon -->
                                <svg v-if="!isDark" class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
                                </svg>
                                <!-- Moon icon -->
                                <svg v-else class="w-3.5 h-3.5 text-primary-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>

                        <!-- Customer Profile Dropdown (when logged in) -->
                        <div v-if="customer" class="relative">
                            <button
                                @click="toggleProfileDropdown"
                                class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-all duration-200"
                                :class="isTransparent ? 'hover:bg-white/10' : 'hover:bg-gray-100 dark:hover:bg-white/10'"
                            >
                                <!-- Avatar -->
                                <div class="h-9 w-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-sm shadow-lg">
                                    {{ customer.initials }}
                                </div>
                                <!-- Name -->
                                <span 
                                    class="font-semibold text-sm"
                                    :class="isTransparent ? 'text-white' : 'text-navy-900 dark:text-white'"
                                >
                                    {{ customer.name }}
                                </span>
                                <!-- Dropdown Icon -->
                                <svg 
                                    class="w-4 h-4 transition-transform"
                                    :class="[
                                        isProfileDropdownOpen ? 'rotate-180' : '',
                                        isTransparent ? 'text-white' : 'text-gray-600 dark:text-gray-300'
                                    ]"
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <transition
                                enter-active-class="transition ease-out duration-200"
                                enter-from-class="opacity-0 scale-95"
                                enter-to-class="opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-150"
                                leave-from-class="opacity-100 scale-100"
                                leave-to-class="opacity-0 scale-95"
                            >
                                <div 
                                    v-show="isProfileDropdownOpen"
                                    class="absolute right-0 mt-2 w-56 bg-white dark:bg-navy-800 rounded-xl shadow-2xl border border-gray-200 dark:border-navy-700 py-2 z-50"
                                >
                                    <!-- User Info -->
                                    <div class="px-4 py-3 border-b border-gray-100 dark:border-navy-700">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ customer.name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-navy-400 truncate">{{ customer.email }}</p>
                                    </div>

                                    <!-- Menu Items -->
                                    <a
                                        :href="route('customer.profile')"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-navy-200 hover:bg-gray-50 dark:hover:bg-navy-700 transition-colors"
                                    >
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        My Profile
                                    </a>

                                    <div class="border-t border-gray-100 dark:border-navy-700 my-1"></div>

                                    <button
                                        @click="handleLogout"
                                        class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                                    >
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </div>
                            </transition>
                        </div>

                        <!-- Login Button (when not logged in) -->
                        <button
                            v-else
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
                        :class="isTransparent ? 'text-white hover:bg-white/10' : 'text-navy-600 dark:text-white hover:bg-navy-100 dark:hover:bg-white/10'"
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
                class="fixed top-0 right-0 bottom-0 w-80 bg-white dark:bg-navy-900 shadow-2xl z-50 lg:hidden overflow-y-auto"
            >
                <!-- Menu Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-navy-700">
                    <div class="flex items-center">
                        <img
                            src="/Azureskill.png"
                            alt="AzureSkill"
                            class="h-10 w-auto"
                            :class="isDark ? 'brightness-0 invert' : ''"
                        />
                    </div>
                    <button
                        @click="isMenuOpen = false"
                        class="p-2 rounded-lg text-navy-600 dark:text-white hover:bg-gray-100 dark:hover:bg-navy-800 transition-colors"
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
                                ? 'bg-gradient-to-r from-primary-50 to-primary-100 dark:from-primary-900/40 dark:to-primary-800/30 text-primary-700 dark:text-primary-300 border-2 border-primary-200 dark:border-primary-700'
                                : 'text-navy-700 dark:text-navy-200 hover:bg-gray-50 dark:hover:bg-navy-800 border-2 border-transparent'"
                        >
                            <span>{{ item.name }}</span>
                            <svg 
                                class="w-5 h-5 transition-transform"
                                :class="isActive(item.href) ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 dark:text-navy-500 group-hover:translate-x-1'"
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </nav>

                    <!-- Dark Mode Toggle (Mobile) -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-navy-700">
                        <button
                            @click="toggleDarkMode"
                            class="flex items-center justify-between w-full px-4 py-3.5 text-base font-semibold rounded-xl transition-all text-navy-700 dark:text-navy-200 hover:bg-gray-50 dark:hover:bg-navy-800 border-2 border-transparent"
                        >
                            <span class="flex items-center">
                                <svg v-if="!isDark" class="w-5 h-5 mr-3 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
                                </svg>
                                <svg v-else class="w-5 h-5 mr-3 text-primary-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd"/>
                                </svg>
                                {{ isDark ? 'Dark Mode' : 'Light Mode' }}
                            </span>
                            <div
                                class="relative w-12 h-6 rounded-full transition-all duration-300"
                                :class="isDark ? 'bg-primary-600' : 'bg-navy-200'"
                            >
                                <div
                                    class="absolute top-0.5 w-5 h-5 rounded-full bg-white shadow-sm transition-all duration-300"
                                    :class="isDark ? 'translate-x-6.5' : 'translate-x-0.5'"
                                ></div>
                            </div>
                        </button>
                    </div>

                    <!-- Login Button -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-navy-700">
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
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-r from-primary-50 to-navy-50 dark:from-navy-800 dark:to-navy-900 border-t border-gray-200 dark:border-navy-700">
                    <p class="text-xs text-navy-600 dark:text-navy-400 text-center">
                        © {{ new Date().getFullYear() }} AzureSkill. All rights reserved.
                    </p>
                </div>
            </div>
        </transition>

        <!-- Auth Modal -->
        <AuthModal :is-open="isAuthModalOpen" @close="closeAuthModal" />
    </header>
</template>
