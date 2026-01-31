<script setup>
import { ref, onMounted } from 'vue';

const isVisible = ref(false);

onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    isVisible.value = true;
                }
            });
        },
        { threshold: 0.1 }
    );

    const section = document.getElementById('cta-section');
    if (section) observer.observe(section);
});

const stats = [
    { value: '200+', label: 'Tutorials', icon: 'book' },
    { value: '10K+', label: 'Learners', icon: 'users' },
    { value: '40+', label: 'Azure Services', icon: 'cloud' },
    { value: '12', label: 'Cert Paths', icon: 'badge' }
];
</script>

<template>
    <section id="cta-section" class="relative py-24 overflow-hidden bg-gradient-to-br from-navy-900 via-primary-900 to-navy-950">
        <!-- SVG Background -->
        <div class="absolute inset-0">
            <svg class="absolute w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hexagons" width="50" height="43.4" patternUnits="userSpaceOnUse" patternTransform="scale(2)">
                        <polygon points="25,0 50,14.4 50,43.4 25,57.7 0,43.4 0,14.4" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hexagons)" />
            </svg>
        </div>

        <!-- Animated Orbs -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s;"></div>

        <!-- Floating Elements -->
        <svg class="absolute top-20 right-20 w-20 h-20 text-white/5 animate-spin-slow" viewBox="0 0 100 100" fill="currentColor">
            <polygon points="50,5 95,30 95,70 50,95 5,70 5,30" />
        </svg>
        <svg class="absolute bottom-20 left-20 w-16 h-16 text-white/5 animate-spin-slow-reverse" viewBox="0 0 100 100" fill="currentColor">
            <rect x="10" y="10" width="80" height="80" rx="15" />
        </svg>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16"
                :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.7s ease-out;"
            >
                <div
                    v-for="(stat, index) in stats"
                    :key="stat.label"
                    class="text-center transition-all duration-500"
                    :style="{ transitionDelay: `${index * 100}ms` }"
                >
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/10">
                        <!-- Book Icon -->
                        <svg v-if="stat.icon === 'book'" class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <!-- Users Icon -->
                        <svg v-if="stat.icon === 'users'" class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <!-- Cloud Icon -->
                        <svg v-if="stat.icon === 'cloud'" class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                        </svg>
                        <!-- Badge Icon -->
                        <svg v-if="stat.icon === 'badge'" class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-white mb-1">{{ stat.value }}</div>
                    <div class="text-primary-200/70 text-sm">{{ stat.label }}</div>
                </div>
            </div>

            <!-- CTA Content -->
            <div
                class="max-w-3xl mx-auto text-center transition-all duration-700 delay-300"
                :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            >
                <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6">
                    Ready to Start Your
                    <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Azure Journey</span>?
                </h2>
                <p class="text-lg text-primary-200/80 mb-10 max-w-2xl mx-auto">
                    Join thousands of learners who are mastering Azure cloud technologies with our free, hands-on tutorials and certification prep resources.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap justify-center gap-4">
                    <a
                        href="/tutorials"
                        class="group relative inline-flex items-center px-8 py-4 text-base font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 active:scale-95"
                    >
                        <div class="absolute inset-0 bg-white"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="relative flex items-center text-navy-900">
                            Browse All Tutorials
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>

                    <a
                        href="/support"
                        class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-white rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 active:scale-95"
                    >
                        <div class="absolute inset-0 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl"></div>
                        <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
                        <span class="relative flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Get Support
                        </span>
                    </a>
                </div>

                <!-- Newsletter Teaser -->
                <div class="mt-12 pt-12 border-t border-white/10">
                    <p class="text-primary-200/60 text-sm">
                        Stay updated with the latest Azure tutorials and tips
                    </p>
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-primary-300/50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <span class="text-primary-200/50 text-sm">Newsletter in Footer</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes spin-slow-reverse {
    from { transform: rotate(360deg); }
    to { transform: rotate(0deg); }
}

.animate-spin-slow {
    animation: spin-slow 30s linear infinite;
}

.animate-spin-slow-reverse {
    animation: spin-slow-reverse 25s linear infinite;
}
</style>
