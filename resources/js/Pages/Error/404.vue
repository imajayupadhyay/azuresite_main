<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';

const isVisible = ref(false);
const mouseX = ref(0);
const mouseY = ref(0);

onMounted(() => {
    setTimeout(() => isVisible.value = true, 100);

    // Track mouse for parallax effect
    const handleMouseMove = (e) => {
        mouseX.value = (e.clientX / window.innerWidth - 0.5) * 20;
        mouseY.value = (e.clientY / window.innerHeight - 0.5) * 20;
    };
    window.addEventListener('mousemove', handleMouseMove);
});

const quickLinks = [
    { name: 'Home', href: '/', icon: 'home' },
    { name: 'Tutorials', href: '/tutorials', icon: 'book' },
    { name: 'Certifications', href: '/certifications', icon: 'badge' },
    { name: 'Live Training', href: '/live-training', icon: 'video' },
];
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900 overflow-hidden">
        <Head>
            <title>404 - Page Not Found | AzureSkill</title>
        </Head>

        <!-- Main Content -->
        <div class="relative min-h-screen flex items-center justify-center px-4 sm:px-6">
            <!-- Animated Background -->
            <div class="absolute inset-0">
                <!-- Grid Pattern -->
                <svg class="absolute w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="error-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                            <path d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#error-grid)" />
                </svg>

                <!-- Animated Orbs -->
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-purple-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

                <!-- Floating Particles -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div v-for="i in 20" :key="i"
                        class="absolute w-2 h-2 bg-white/20 rounded-full animate-float-particle"
                        :style="{
                            left: `${Math.random() * 100}%`,
                            top: `${Math.random() * 100}%`,
                            animationDelay: `${Math.random() * 5}s`,
                            animationDuration: `${5 + Math.random() * 10}s`
                        }"
                    ></div>
                </div>

                <!-- Floating Shapes -->
                <div class="absolute top-20 left-[10%] animate-float-slow">
                    <div class="w-16 h-16 border-2 border-white/10 rounded-xl rotate-45"></div>
                </div>
                <div class="absolute top-40 right-[15%] animate-float-delayed">
                    <div class="w-12 h-12 border-2 border-white/10 rounded-full"></div>
                </div>
                <div class="absolute bottom-32 left-[20%] animate-float-slow" style="animation-delay: 1s;">
                    <div class="w-20 h-20 border-2 border-white/10 rounded-2xl rotate-12"></div>
                </div>
                <div class="absolute bottom-40 right-[10%] animate-float-delayed" style="animation-delay: 2s;">
                    <div class="w-8 h-8 bg-white/5 rounded-lg rotate-45"></div>
                </div>
            </div>

            <!-- Content -->
            <div
                class="relative z-10 text-center max-w-2xl mx-auto transition-all duration-1000"
                :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
            >
                <!-- Animated 404 Number -->
                <div
                    class="relative mb-8"
                    :style="{ transform: `translate(${mouseX * 0.5}px, ${mouseY * 0.5}px)` }"
                >
                    <!-- Glowing Background -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-[200px] sm:text-[280px] font-black text-white/5 select-none blur-sm">
                            404
                        </div>
                    </div>

                    <!-- Main Number -->
                    <div class="relative">
                        <h1 class="text-[120px] sm:text-[180px] font-black leading-none">
                            <span class="bg-gradient-to-r from-blue-400 via-primary-400 to-purple-400 bg-clip-text text-transparent animate-gradient-x">
                                4
                            </span>
                            <span class="relative inline-block">
                                <span class="bg-gradient-to-r from-primary-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent animate-gradient-x" style="animation-delay: 0.5s;">
                                    0
                                </span>
                                <!-- Animated Ring -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-24 h-24 sm:w-32 sm:h-32 border-4 border-dashed border-white/20 rounded-full animate-spin-slow"></div>
                                </div>
                            </span>
                            <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-primary-400 bg-clip-text text-transparent animate-gradient-x" style="animation-delay: 1s;">
                                4
                            </span>
                        </h1>
                    </div>
                </div>

                <!-- Glitch Effect Text -->
                <div class="relative mb-6">
                    <h2 class="text-2xl sm:text-3xl font-bold text-white mb-2">
                        Oops! Page Not Found
                    </h2>
                    <p class="text-primary-200/70 text-sm sm:text-base max-w-md mx-auto">
                        The page you're looking for seems to have wandered off into the cloud.
                        Let's get you back on track.
                    </p>
                </div>

                <!-- Animated Search Bar (decorative) -->
                <div class="relative max-w-md mx-auto mb-10">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-2xl p-2 border border-white/20">
                        <div class="flex-1 flex items-center px-4">
                            <svg class="w-5 h-5 text-primary-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span class="text-white/50 text-sm">Looking for something?</span>
                        </div>
                        <a
                            href="/tutorials"
                            class="px-6 py-3 bg-gradient-to-r from-primary-600 to-blue-600 text-white font-semibold rounded-xl hover:from-primary-500 hover:to-blue-500 transition-all duration-300 text-sm"
                        >
                            Browse Tutorials
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mb-10">
                    <a
                        v-for="link in quickLinks"
                        :key="link.name"
                        :href="link.href"
                        class="group flex flex-col items-center p-4 sm:p-5 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-300 hover:-translate-y-1"
                    >
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500/20 to-blue-500/20 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <svg v-if="link.icon === 'home'" class="w-6 h-6 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <svg v-else-if="link.icon === 'book'" class="w-6 h-6 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <svg v-else-if="link.icon === 'badge'" class="w-6 h-6 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            <svg v-else-if="link.icon === 'video'" class="w-6 h-6 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-white font-medium text-sm">{{ link.name }}</span>
                    </a>
                </div>

                <!-- Back Button -->
                <a
                    href="/"
                    class="inline-flex items-center px-6 py-3 text-primary-200 hover:text-white transition-colors group"
                >
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Home
                </a>
            </div>

            <!-- Decorative Cloud Icons -->
            <div class="absolute bottom-10 left-10 opacity-20 hidden lg:block">
                <svg class="w-24 h-24 text-white animate-float-slow" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/>
                </svg>
            </div>
            <div class="absolute top-20 right-10 opacity-10 hidden lg:block">
                <svg class="w-32 h-32 text-white animate-float-delayed" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/>
                </svg>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(-5deg); }
}

@keyframes float-particle {
    0%, 100% {
        transform: translateY(0) translateX(0);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100vh) translateX(20px);
        opacity: 0;
    }
}

@keyframes gradient-x {
    0%, 100% {
        background-size: 200% 200%;
        background-position: left center;
    }
    50% {
        background-size: 200% 200%;
        background-position: right center;
    }
}

@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 8s ease-in-out infinite;
}

.animate-float-particle {
    animation: float-particle 15s linear infinite;
}

.animate-gradient-x {
    animation: gradient-x 3s ease infinite;
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}
</style>
