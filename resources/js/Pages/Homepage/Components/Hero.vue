<script setup>
import { ref, onMounted } from 'vue';

const isVisible = ref(false);

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
});

const stats = [
    { value: '50+', label: 'Hands-on Labs' },
    { value: '200+', label: 'Tutorials' },
    { value: '100+', label: 'Azure Services' },
    { value: '10K+', label: 'Learners' },
];
</script>

<template>
    <section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900">
        <!-- Animated Gradient Mesh Background -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Animated Gradient Orbs -->
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-gradient-to-br from-primary-500/30 to-primary-700/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute top-1/3 right-1/4 w-[500px] h-[500px] bg-gradient-to-br from-primary-400/25 to-navy-600/20 rounded-full blur-3xl animate-pulse-medium"></div>
            <div class="absolute bottom-0 left-1/2 w-[700px] h-[700px] bg-gradient-to-br from-primary-600/20 to-navy-700/15 rounded-full blur-3xl animate-pulse-fast"></div>
            
            <!-- Grid Pattern Overlay -->
            <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="glass-grid" width="80" height="80" patternUnits="userSpaceOnUse">
                        <path d="M 80 0 L 0 0 0 80" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#glass-grid)" class="text-white"/>
            </svg>

            <!-- Floating Glass Particles -->
            <div class="absolute top-20 left-[15%] w-20 h-20 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 animate-float-1 rotate-12"></div>
            <div class="absolute top-40 right-[20%] w-16 h-16 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 animate-float-2 -rotate-6"></div>
            <div class="absolute bottom-40 left-[10%] w-24 h-24 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 animate-float-3 rotate-45"></div>
            <div class="absolute bottom-60 right-[15%] w-14 h-14 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 animate-float-4 -rotate-12"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[calc(100vh-200px)]">
                <!-- Left Content -->
                <div
                    class="transition-all duration-1000 ease-out"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <!-- Glass Badge -->
                    <div class="inline-flex items-center px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-8 shadow-lg shadow-primary-500/20">
                        <span class="relative flex w-2.5 h-2.5 mr-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                        </span>
                        <span class="text-sm font-medium text-white/90">Your Azure Learning Journey Starts Here</span>
                    </div>

                    <!-- Heading with Glass Effect -->
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        <span class="block text-white mb-2">Master</span>
                        <span class="relative inline-block">
                            <span class="relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-primary-300 via-primary-200 to-white animate-gradient">
                                Azure Cloud
                            </span>
                            <div class="absolute -bottom-2 left-0 w-full h-3 bg-gradient-to-r from-primary-400/50 to-primary-500/50 blur-xl"></div>
                        </span>
                        <br />
                        <span class="block text-white mt-2">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-primary-200">Hands-On</span>
                        </span>
                    </h1>

                    <!-- Description in Glass Container -->
                    <div class="relative mb-10">
                        <p class="text-lg sm:text-xl text-white/80 leading-relaxed max-w-xl">
                            Dive deep into Azure with real-world projects, interactive labs, and comprehensive tutorials.
                            <span class="text-white font-semibold">Build practical skills</span> that employers demand.
                        </p>
                    </div>

                    <!-- CTA Buttons with Glass Effect -->
                    <div class="flex flex-wrap gap-4 mb-12">
                        <a
                            href="/labs"
                            class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-navy-950 overflow-hidden rounded-2xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-2xl shadow-primary-500/50"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-primary-300 via-white to-primary-200"></div>
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-white via-primary-100 to-white"></div>
                            </div>
                            <span class="relative flex items-center font-bold">
                                Start Learning Free
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </a>

                        <a
                            href="/tutorials"
                            class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-white overflow-hidden rounded-2xl transition-all duration-300 hover:scale-105 active:scale-95"
                        >
                            <div class="absolute inset-0 bg-white/10 backdrop-blur-md border border-white/20"></div>
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/20"></div>
                            <span class="relative flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                                Watch Tutorials
                            </span>
                        </a>
                    </div>

                    <!-- Stats in Glass Cards -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div
                            v-for="(stat, index) in stats"
                            :key="stat.label"
                            class="relative group transition-all duration-700 ease-out"
                            :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            :style="{ transitionDelay: `${(index + 2) * 100}ms` }"
                        >
                            <div class="relative p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 hover:bg-white/15 hover:border-white/30 transition-all duration-300 hover:scale-105">
                                <div class="text-3xl sm:text-4xl font-bold text-white mb-1">{{ stat.value }}</div>
                                <div class="text-xs sm:text-sm text-white/70">{{ stat.label }}</div>
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-primary-400/0 to-primary-600/0 group-hover:from-primary-400/10 group-hover:to-primary-600/10 transition-all duration-300"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Ultra Modern Glass Cards -->
                <div
                    class="relative transition-all duration-1000 ease-out delay-300"
                    :class="isVisible ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-8'"
                >
                    <div class="relative">
                        <!-- Main Glass Container with 3D Effect -->
                        <div class="relative group">
                            <!-- Background Glow -->
                            <div class="absolute -inset-4 bg-gradient-to-r from-primary-500/30 to-primary-600/30 rounded-[2rem] blur-2xl group-hover:blur-3xl transition-all duration-500"></div>
                            
                            <!-- Main Glass Panel -->
                            <div class="relative bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/20 p-8 shadow-2xl hover:bg-white/15 transition-all duration-500">
                                <!-- Azure Services Grid -->
                                <div class="grid grid-cols-3 gap-3 mb-6">
                                    <!-- Service Icons with Glass Effect -->
                                    <div class="group/item relative">
                                        <div class="p-5 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 hover:bg-white/20 hover:border-primary-300/50 transition-all duration-300 cursor-pointer hover:scale-110 hover:-translate-y-1">
                                            <svg class="w-10 h-10 mx-auto text-primary-200 group-hover/item:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M5 12.5c0-2.5 2-4.5 4.5-4.5 .5-2.5 2.5-4 5-4 3 0 5.5 2.5 5.5 5.5 0 .2 0 .3 0 .5 1.5.5 2.5 2 2.5 3.5 0 2-1.5 4-4 4H6c-2.5 0-4-2-4-4 0-1.5 1-3 3-3.5"/>
                                            </svg>
                                            <p class="text-xs text-center mt-2 text-white/80 font-medium">Cloud</p>
                                        </div>
                                    </div>

                                    <div class="group/item relative">
                                        <div class="p-5 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 hover:bg-white/20 hover:border-primary-300/50 transition-all duration-300 cursor-pointer hover:scale-110 hover:-translate-y-1">
                                            <svg class="w-10 h-10 mx-auto text-primary-200 group-hover/item:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                                <path d="M8 21h8M12 17v4"/>
                                            </svg>
                                            <p class="text-xs text-center mt-2 text-white/80 font-medium">VMs</p>
                                        </div>
                                    </div>

                                    <div class="group/item relative">
                                        <div class="p-5 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 hover:bg-white/20 hover:border-primary-300/50 transition-all duration-300 cursor-pointer hover:scale-110 hover:-translate-y-1">
                                            <svg class="w-10 h-10 mx-auto text-primary-200 group-hover/item:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M4 6h16M4 12h16M4 18h16"/>
                                                <circle cx="8" cy="6" r="1" fill="currentColor"/>
                                                <circle cx="8" cy="12" r="1" fill="currentColor"/>
                                                <circle cx="8" cy="18" r="1" fill="currentColor"/>
                                            </svg>
                                            <p class="text-xs text-center mt-2 text-white/80 font-medium">Storage</p>
                                        </div>
                                    </div>

                                    <div class="group/item relative">
                                        <div class="p-5 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 hover:bg-white/20 hover:border-primary-300/50 transition-all duration-300 cursor-pointer hover:scale-110 hover:-translate-y-1">
                                            <svg class="w-10 h-10 mx-auto text-primary-200 group-hover/item:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                            </svg>
                                            <p class="text-xs text-center mt-2 text-white/80 font-medium">Database</p>
                                        </div>
                                    </div>

                                    <div class="group/item relative">
                                        <div class="p-5 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 hover:bg-white/20 hover:border-primary-300/50 transition-all duration-300 cursor-pointer hover:scale-110 hover:-translate-y-1">
                                            <svg class="w-10 h-10 mx-auto text-primary-200 group-hover/item:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                            </svg>
                                            <p class="text-xs text-center mt-2 text-white/80 font-medium">Security</p>
                                        </div>
                                    </div>

                                    <div class="group/item relative">
                                        <div class="p-5 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 hover:bg-white/20 hover:border-primary-300/50 transition-all duration-300 cursor-pointer hover:scale-110 hover:-translate-y-1">
                                            <svg class="w-10 h-10 mx-auto text-primary-200 group-hover/item:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <circle cx="12" cy="12" r="3"/>
                                                <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/>
                                            </svg>
                                            <p class="text-xs text-center mt-2 text-white/80 font-medium">DevOps</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Progress Indicator with Glass Effect -->
                                <div class="relative bg-white/10 backdrop-blur-xl rounded-2xl p-5 border border-white/20">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-sm font-semibold text-white">Your Learning Progress</span>
                                        <span class="text-lg font-bold text-primary-200">68%</span>
                                    </div>
                                    <div class="relative h-3 bg-white/10 rounded-full overflow-hidden backdrop-blur-sm">
                                        <div class="absolute inset-0 bg-gradient-to-r from-primary-400/30 to-primary-600/30 animate-pulse"></div>
                                        <div class="relative h-full w-[68%] bg-gradient-to-r from-primary-300 via-primary-200 to-white rounded-full shadow-lg shadow-primary-400/50 animate-progress"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Glass Achievement Cards -->
                        <div class="absolute -top-6 -right-6 bg-white/10 backdrop-blur-2xl rounded-2xl p-4 shadow-2xl border border-white/30 animate-float-slow hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/50">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">Lab Completed!</p>
                                    <p class="text-xs text-white/70">Azure Functions</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-4 -left-4 bg-white/10 backdrop-blur-2xl rounded-2xl p-4 shadow-2xl border border-white/30 animate-float-medium hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/50">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">Live Labs</p>
                                    <p class="text-xs text-white/70">Practice in real Azure</p>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Floating Element -->
                        <div class="absolute top-1/2 -left-8 bg-white/10 backdrop-blur-2xl rounded-xl p-3 shadow-xl border border-white/30 animate-float-fast hover:scale-105 transition-transform duration-300">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center shadow-lg shadow-yellow-500/50 mb-2">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-white">Pro</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator with Glass Effect -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center animate-bounce-slow">
            <div class="px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-2">
                <span class="text-sm text-white/80">Scroll to explore</span>
            </div>
            <div class="w-6 h-10 rounded-full border-2 border-white/30 flex items-start justify-center p-2">
                <div class="w-1.5 h-3 bg-white/80 rounded-full animate-scroll-indicator"></div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes pulse-slow {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.05); }
}

@keyframes pulse-medium {
    0%, 100% { opacity: 0.25; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(1.08); }
}

@keyframes pulse-fast {
    0%, 100% { opacity: 0.2; transform: scale(1); }
    50% { opacity: 0.35; transform: scale(1.1); }
}

@keyframes float-1 {
    0%, 100% { transform: translateY(0px) translateX(0px) rotate(12deg); }
    33% { transform: translateY(-20px) translateX(10px) rotate(15deg); }
    66% { transform: translateY(-10px) translateX(-10px) rotate(9deg); }
}

@keyframes float-2 {
    0%, 100% { transform: translateY(0px) translateX(0px) rotate(-6deg); }
    33% { transform: translateY(-15px) translateX(-15px) rotate(-9deg); }
    66% { transform: translateY(-25px) translateX(5px) rotate(-3deg); }
}

@keyframes float-3 {
    0%, 100% { transform: translateY(0px) translateX(0px) rotate(45deg); }
    33% { transform: translateY(-18px) translateX(-8px) rotate(48deg); }
    66% { transform: translateY(-8px) translateX(12px) rotate(42deg); }
}

@keyframes float-4 {
    0%, 100% { transform: translateY(0px) translateX(0px) rotate(-12deg); }
    33% { transform: translateY(-22px) translateX(8px) rotate(-15deg); }
    66% { transform: translateY(-12px) translateX(-12px) rotate(-9deg); }
}

@keyframes float-slow {
    0%, 100% { transform: translateY(0px) translateX(0px); }
    50% { transform: translateY(-15px) translateX(-5px); }
}

@keyframes float-medium {
    0%, 100% { transform: translateY(0px) translateX(0px); }
    50% { transform: translateY(-12px) translateX(5px); }
}

@keyframes float-fast {
    0%, 100% { transform: translateY(0px) translateX(0px); }
    50% { transform: translateY(-10px) translateX(-3px); }
}

@keyframes bounce-slow {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(-10px); }
}

@keyframes scroll-indicator {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(12px); }
}

@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes progress {
    0% { box-shadow: 0 0 10px rgba(162, 179, 248, 0.5); }
    50% { box-shadow: 0 0 20px rgba(162, 179, 248, 0.8), 0 0 30px rgba(162, 179, 248, 0.5); }
    100% { box-shadow: 0 0 10px rgba(162, 179, 248, 0.5); }
}

.animate-pulse-slow {
    animation: pulse-slow 8s ease-in-out infinite;
}

.animate-pulse-medium {
    animation: pulse-medium 6s ease-in-out infinite;
}

.animate-pulse-fast {
    animation: pulse-fast 4s ease-in-out infinite;
}

.animate-float-1 {
    animation: float-1 20s ease-in-out infinite;
}

.animate-float-2 {
    animation: float-2 18s ease-in-out infinite;
}

.animate-float-3 {
    animation: float-3 22s ease-in-out infinite;
}

.animate-float-4 {
    animation: float-4 19s ease-in-out infinite;
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

.animate-bounce-slow {
    animation: bounce-slow 3s ease-in-out infinite;
}

.animate-scroll-indicator {
    animation: scroll-indicator 2s ease-in-out infinite;
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

.animate-progress {
    animation: progress 2s ease-in-out infinite;
}
</style>
