<script setup>
import { ref, onMounted } from 'vue';

const isVisible = ref(false);

onMounted(() => {
    isVisible.value = true;
});

const stats = [
    { value: '50+', label: 'Hands-on Labs' },
    { value: '200+', label: 'Tutorials' },
    { value: '100+', label: 'Azure Services' },
    { value: '10K+', label: 'Learners' },
];
</script>

<template>
    <section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-primary-50 via-white to-navy-50">
        <!-- SVG Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Grid Pattern -->
            <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="currentColor" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" class="text-navy-900"/>
            </svg>

            <!-- Floating Cloud Elements -->
            <svg class="absolute top-20 left-10 w-64 h-64 text-primary-200/40 animate-float-slow" viewBox="0 0 200 200" fill="currentColor">
                <ellipse cx="100" cy="100" rx="80" ry="50"/>
                <ellipse cx="60" cy="80" rx="50" ry="35"/>
                <ellipse cx="140" cy="85" rx="45" ry="30"/>
            </svg>

            <svg class="absolute top-40 right-20 w-48 h-48 text-primary-300/30 animate-float-medium" viewBox="0 0 200 200" fill="currentColor">
                <ellipse cx="100" cy="100" rx="70" ry="45"/>
                <ellipse cx="55" cy="85" rx="40" ry="28"/>
                <ellipse cx="145" cy="88" rx="35" ry="25"/>
            </svg>

            <svg class="absolute bottom-40 left-1/4 w-56 h-56 text-primary-200/30 animate-float-fast" viewBox="0 0 200 200" fill="currentColor">
                <ellipse cx="100" cy="100" rx="75" ry="48"/>
                <ellipse cx="58" cy="82" rx="45" ry="32"/>
                <ellipse cx="142" cy="86" rx="40" ry="28"/>
            </svg>

            <!-- Abstract Shapes -->
            <svg class="absolute top-1/3 right-10 w-96 h-96 opacity-10" viewBox="0 0 400 400" fill="none">
                <circle cx="200" cy="200" r="150" stroke="#1e2a5e" stroke-width="1"/>
                <circle cx="200" cy="200" r="120" stroke="#1e2a5e" stroke-width="1"/>
                <circle cx="200" cy="200" r="90" stroke="#1e2a5e" stroke-width="1"/>
                <circle cx="200" cy="200" r="60" stroke="#1e2a5e" stroke-width="1"/>
            </svg>

            <!-- Dotted Pattern -->
            <svg class="absolute bottom-20 right-1/4 w-32 h-32 text-primary-400/20" viewBox="0 0 100 100">
                <pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="2" fill="currentColor"/>
                </pattern>
                <rect width="100" height="100" fill="url(#dots)"/>
            </svg>

            <!-- Gradient Orbs -->
            <div class="absolute top-1/4 left-1/3 w-[500px] h-[500px] bg-primary-200/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] bg-primary-300/15 rounded-full blur-3xl"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[calc(100vh-200px)]">
                <!-- Left Content -->
                <div
                    class="transition-all duration-1000 ease-out"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <!-- Badge -->
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-100/50 backdrop-blur-sm border border-primary-200/30 mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>
                        <span class="text-sm font-medium text-primary-800">Your Azure Learning Journey Starts Here</span>
                    </div>

                    <!-- Heading -->
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-navy-950 leading-tight mb-6">
                        Master <span class="relative inline-block">
                            <span class="relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800">Azure</span>
                            <svg class="absolute -bottom-2 left-0 w-full h-3 text-primary-300" viewBox="0 0 200 12" preserveAspectRatio="none">
                                <path d="M0,8 Q50,0 100,8 T200,8" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800">Hands-On</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-lg sm:text-xl text-navy-600 mb-8 max-w-xl leading-relaxed">
                        Dive deep into Azure with real-world projects, interactive labs, and comprehensive tutorials.
                        Build practical skills that employers demand.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 mb-12">
                        <a
                            href="/labs"
                            class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-white overflow-hidden rounded-2xl transition-all duration-300 active:scale-95"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-primary-800 group-hover:from-primary-500 group-hover:to-primary-700 transition-all duration-300"></div>
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="absolute inset-0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                            </div>
                            <span class="relative flex items-center">
                                Start Learning Free
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </a>

                        <a
                            href="/tutorials"
                            class="group inline-flex items-center px-8 py-4 text-base font-semibold text-primary-800 bg-white/60 backdrop-blur-sm border-2 border-primary-200 hover:border-primary-400 hover:bg-white rounded-2xl transition-all duration-300 active:scale-95"
                        >
                            <svg class="w-5 h-5 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            Watch Tutorials
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                        <div
                            v-for="(stat, index) in stats"
                            :key="stat.label"
                            class="text-center sm:text-left transition-all duration-700 ease-out"
                            :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            :style="{ transitionDelay: `${(index + 1) * 100}ms` }"
                        >
                            <div class="text-3xl sm:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800">{{ stat.value }}</div>
                            <div class="text-sm text-navy-600">{{ stat.label }}</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Illustration -->
                <div
                    class="relative transition-all duration-1000 ease-out delay-300"
                    :class="isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                >
                    <div class="relative">
                        <!-- Main Illustration Card -->
                        <div class="relative bg-white/40 backdrop-blur-xl rounded-3xl border border-primary-200/50 p-8 shadow-2xl shadow-navy-900/10">
                            <!-- Azure Services Grid -->
                            <div class="grid grid-cols-3 gap-4 mb-6">
                                <!-- Service Icons -->
                                <div class="group p-4 bg-white/60 rounded-2xl border border-primary-100 hover:border-primary-300 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <svg class="w-10 h-10 mx-auto text-primary-600 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M5 12.5c0-2.5 2-4.5 4.5-4.5 .5-2.5 2.5-4 5-4 3 0 5.5 2.5 5.5 5.5 0 .2 0 .3 0 .5 1.5.5 2.5 2 2.5 3.5 0 2-1.5 4-4 4H6c-2.5 0-4-2-4-4 0-1.5 1-3 3-3.5"/>
                                    </svg>
                                    <p class="text-xs text-center mt-2 text-navy-700 font-medium">Cloud</p>
                                </div>

                                <div class="group p-4 bg-white/60 rounded-2xl border border-primary-100 hover:border-primary-300 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <svg class="w-10 h-10 mx-auto text-primary-600 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="2" y="3" width="20" height="14" rx="2"/>
                                        <path d="M8 21h8M12 17v4"/>
                                    </svg>
                                    <p class="text-xs text-center mt-2 text-navy-700 font-medium">VMs</p>
                                </div>

                                <div class="group p-4 bg-white/60 rounded-2xl border border-primary-100 hover:border-primary-300 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <svg class="w-10 h-10 mx-auto text-primary-600 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M4 6h16M4 12h16M4 18h16"/>
                                        <circle cx="8" cy="6" r="1" fill="currentColor"/>
                                        <circle cx="8" cy="12" r="1" fill="currentColor"/>
                                        <circle cx="8" cy="18" r="1" fill="currentColor"/>
                                    </svg>
                                    <p class="text-xs text-center mt-2 text-navy-700 font-medium">Storage</p>
                                </div>

                                <div class="group p-4 bg-white/60 rounded-2xl border border-primary-100 hover:border-primary-300 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <svg class="w-10 h-10 mx-auto text-primary-600 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                    </svg>
                                    <p class="text-xs text-center mt-2 text-navy-700 font-medium">Database</p>
                                </div>

                                <div class="group p-4 bg-white/60 rounded-2xl border border-primary-100 hover:border-primary-300 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <svg class="w-10 h-10 mx-auto text-primary-600 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    </svg>
                                    <p class="text-xs text-center mt-2 text-navy-700 font-medium">Security</p>
                                </div>

                                <div class="group p-4 bg-white/60 rounded-2xl border border-primary-100 hover:border-primary-300 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <svg class="w-10 h-10 mx-auto text-primary-600 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="3"/>
                                        <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/>
                                    </svg>
                                    <p class="text-xs text-center mt-2 text-navy-700 font-medium">DevOps</p>
                                </div>
                            </div>

                            <!-- Progress Indicator -->
                            <div class="bg-primary-50/80 rounded-2xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-navy-800">Your Learning Progress</span>
                                    <span class="text-sm font-bold text-primary-600">68%</span>
                                </div>
                                <div class="h-2 bg-primary-200/50 rounded-full overflow-hidden">
                                    <div class="h-full w-[68%] bg-gradient-to-r from-primary-500 to-primary-700 rounded-full"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -top-6 -right-6 bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-xl border border-primary-100 animate-float-slow">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-navy-900">Lab Completed!</p>
                                    <p class="text-xs text-navy-600">Azure Functions</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-4 -left-4 bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-xl border border-primary-100 animate-float-medium">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-navy-900">Live Labs</p>
                                    <p class="text-xs text-navy-600">Practice in real Azure</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center animate-bounce">
            <span class="text-sm text-navy-600 mb-2">Scroll to explore</span>
            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>
</template>

<style scoped>
@keyframes float-slow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes float-medium {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

@keyframes float-fast {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-medium {
    animation: float-medium 5s ease-in-out infinite;
}

.animate-float-fast {
    animation: float-fast 4s ease-in-out infinite;
}
</style>
