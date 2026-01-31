<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';

const isVisible = ref(false);

onMounted(() => {
    setTimeout(() => isVisible.value = true, 100);
});
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900 overflow-hidden">
        <Head>
            <title>500 - Server Error | AzureSkill</title>
        </Head>

        <!-- Main Content -->
        <div class="relative min-h-screen flex items-center justify-center px-4 sm:px-6">
            <!-- Background -->
            <div class="absolute inset-0">
                <svg class="absolute w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="error-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                            <path d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#error-grid)" />
                </svg>

                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-red-500/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-orange-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            </div>

            <!-- Content -->
            <div
                class="relative z-10 text-center max-w-xl mx-auto transition-all duration-1000"
                :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
            >
                <!-- Error Icon -->
                <div class="mb-8">
                    <div class="w-32 h-32 mx-auto relative">
                        <div class="absolute inset-0 bg-red-500/20 rounded-full animate-ping"></div>
                        <div class="relative w-32 h-32 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <h1 class="text-6xl sm:text-8xl font-black text-white mb-4">500</h1>
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Server Error</h2>
                <p class="text-primary-200/70 mb-8 max-w-md mx-auto">
                    Something went wrong on our end. We're working to fix it. Please try again later.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a
                        href="/"
                        class="px-8 py-4 bg-white text-navy-900 font-semibold rounded-xl hover:bg-primary-50 transition-colors"
                    >
                        Go to Home
                    </a>
                    <button
                        @click="window.location.reload()"
                        class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl border border-white/20 hover:bg-white/20 transition-colors"
                    >
                        Try Again
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
