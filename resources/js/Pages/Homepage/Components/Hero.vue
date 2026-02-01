<script setup>
import { ref, onMounted } from 'vue';

const isVisible = ref(false);

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
});
</script>

<template>
    <section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900">
        <!-- SVG Background Pattern -->
        <div class="absolute inset-0 opacity-30">
            <svg class="absolute w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(255,255,255,0.08)" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <!-- Animated Gradient Orbs -->
        <div class="absolute top-20 left-10 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary-600/10 rounded-full blur-3xl"></div>

        <!-- Floating SVG Shapes -->
        <svg class="absolute top-32 right-20 w-24 h-24 text-primary-400/20 animate-float" viewBox="0 0 100 100" fill="currentColor">
            <polygon points="50,5 95,30 95,70 50,95 5,70 5,30" />
        </svg>
        <svg class="absolute bottom-40 left-20 w-16 h-16 text-blue-400/20 animate-float-delayed" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="45" />
        </svg>
        <svg class="absolute top-1/3 left-1/4 w-12 h-12 text-primary-300/15 animate-float" viewBox="0 0 100 100" fill="currentColor">
            <rect x="15" y="15" width="70" height="70" rx="10" transform="rotate(45 50 50)" />
        </svg>

        <!-- Azure Logo SVG -->
        <div class="absolute top-1/4 right-1/4 opacity-5">
            <svg class="w-96 h-96" viewBox="0 0 96 96" fill="currentColor">
                <path class="text-white" d="M47.7 20.5L28.9 58.4l30.3-5.5-11.5 22.6 25.2-35.5H47.4l9.5-19.5h-9.2z"/>
            </svg>
        </div>

        <!-- Content -->
        <div class="relative h-screen flex items-center justify-center px-4">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-8 transition-all duration-700"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                >
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    <span class="text-sm text-primary-100">200+ Free Tutorials Available</span>
                </div>

                <!-- Main Heading -->
                <h1
                    class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6 transition-all duration-700 delay-100"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    Master
                    <span class="bg-gradient-to-r from-blue-400 via-primary-300 to-blue-400 bg-clip-text text-transparent"> Azure Cloud</span>
                    <br class="hidden sm:block" />
                    The Hands-On Way
                </h1>

                <!-- Subtitle -->
                <p
                    class="text-lg sm:text-xl text-primary-200/80 max-w-2xl mx-auto mb-10 transition-all duration-700 delay-200"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    Learn Microsoft Azure with practical tutorials, comprehensive certification guides, and expert-led live training sessions.
                </p>

                <!-- CTA Buttons -->
                <div
                    class="flex flex-wrap justify-center gap-4 transition-all duration-700 delay-300"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <a
                        href="/tutorials"
                        class="group relative inline-flex items-center px-8 py-4 text-base font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 active:scale-95 shadow-2xl shadow-primary-500/25"
                    >
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-primary-500"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-primary-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="relative flex items-center text-white">
                            Start Learning
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>

                    <a
                        href="/certifications"
                        class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-white rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 active:scale-95"
                    >
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl"></div>
                        <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                        <span class="relative flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            Get Certified
                        </span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div
                    class="mt-16 flex flex-wrap justify-center items-center gap-8 transition-all duration-700 delay-400"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <div class="flex items-center gap-2 text-primary-200/60">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        <span class="text-sm">4.9/5 Rating</span>
                    </div>
                    <div class="w-px h-4 bg-primary-200/20"></div>
                    <div class="flex items-center gap-2 text-primary-200/60">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                        </svg>
                        <span class="text-sm">10K+ Learners</span>
                    </div>
                    <div class="w-px h-4 bg-primary-200/20"></div>
                    <div class="flex items-center gap-2 text-primary-200/60">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <span class="text-sm">100% Free</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-primary-200/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>
</template>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(-5deg); }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 8s ease-in-out infinite;
    animation-delay: 2s;
}
</style>
