<script setup>
import { ref } from 'vue';

const isMenuOpen = ref(false);
const activeNav = ref('Home');

const navigation = [
    { name: 'Home', href: '/' },
    { name: 'Labs', href: '/labs' },
    { name: 'Tutorials', href: '/tutorials' },
    { name: 'Services', href: '/services' },
    { name: 'Blogs', href: '/blogs' },
    { name: 'Pricing', href: '/pricing' },
];
</script>

<template>
    <header class="fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <!-- Glass Header Container -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg shadow-navy-900/5 border border-navy-200/50 px-6 py-3">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <a href="/" class="flex items-center space-x-2 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-primary-900 rounded-xl flex items-center justify-center group-hover:from-primary-500 group-hover:to-primary-800 transition-all shadow-lg shadow-primary-600/25">
                            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-navy-900">AzureSkill</span>
                    </a>

                    <!-- Desktop Navigation -->
                    <nav class="hidden lg:flex items-center bg-navy-100 rounded-xl p-1">
                        <a
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            @click="activeNav = item.name"
                            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300"
                            :class="activeNav === item.name
                                ? 'bg-white text-primary-600 shadow-sm'
                                : 'text-navy-600 hover:text-navy-900'"
                        >
                            {{ item.name }}
                        </a>
                    </nav>

                    <!-- Right Actions -->
                    <div class="hidden lg:flex items-center space-x-3">
                        <!-- Theme Toggle (decorative) -->
                        <div class="flex items-center bg-navy-100 rounded-xl p-1">
                            <button class="px-3 py-1.5 text-sm font-medium bg-white text-navy-900 rounded-lg shadow-sm">
                                Light
                            </button>
                            <button class="px-3 py-1.5 text-sm font-medium text-navy-500 rounded-lg hover:text-navy-700 transition-colors">
                                Dark
                            </button>
                        </div>

                        <!-- Login Button -->
                        <a
                            href="/login"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-800 hover:from-primary-500 hover:to-primary-700 rounded-xl transition-all duration-300 active:scale-95 shadow-lg shadow-primary-600/25"
                        >
                            Login / Signup
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <button
                        @click="isMenuOpen = !isMenuOpen"
                        class="lg:hidden p-2 rounded-xl text-navy-600 hover:bg-navy-100 active:scale-95 transition-all"
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

                <!-- Mobile Navigation -->
                <transition
                    enter-active-class="transition-all duration-300 ease-out"
                    enter-from-class="opacity-0 max-h-0"
                    enter-to-class="opacity-100 max-h-96"
                    leave-active-class="transition-all duration-200 ease-in"
                    leave-from-class="opacity-100 max-h-96"
                    leave-to-class="opacity-0 max-h-0"
                >
                    <div v-show="isMenuOpen" class="lg:hidden overflow-hidden">
                        <div class="pt-4 mt-4 border-t border-navy-200">
                            <div class="space-y-1">
                                <a
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="item.href"
                                    class="block px-4 py-3 text-base font-medium rounded-xl transition-all"
                                    :class="activeNav === item.name
                                        ? 'bg-primary-50 text-primary-600'
                                        : 'text-navy-600 hover:bg-navy-50 hover:text-navy-900'"
                                >
                                    {{ item.name }}
                                </a>
                            </div>
                            <div class="mt-4 pt-4 border-t border-navy-200">
                                <a
                                    href="/login"
                                    class="block w-full text-center px-4 py-3 text-base font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-800 rounded-xl transition-all"
                                >
                                    Login / Signup
                                </a>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </header>
</template>
