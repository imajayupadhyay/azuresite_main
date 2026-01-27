<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const isVisible = ref(false);
const searchQuery = ref('');

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

const handleSearch = () => {
    if (searchQuery.value.trim()) {
        router.visit('/tutorials', {
            data: { search: searchQuery.value },
            preserveState: true
        });
    } else {
        router.visit('/tutorials');
    }
};

const handleKeyPress = (event) => {
    if (event.key === 'Enter') {
        handleSearch();
    }
};
</script>

<template>
    <section class="relative min-h-screen overflow-hidden bg-white">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Subtle Gradient Orbs -->
            <div class="absolute top-20 -right-40 w-[500px] h-[500px] bg-gradient-to-br from-primary-100/40 to-primary-200/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] bg-gradient-to-tr from-primary-50/60 to-navy-100/30 rounded-full blur-3xl animate-pulse-medium"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-gradient-to-br from-primary-50/30 to-transparent rounded-full blur-3xl animate-pulse-fast"></div>
            
            <!-- Dotted Pattern -->
            <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dots-pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1" fill="#1e293b"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots-pattern)"/>
            </svg>

            <!-- Geometric Shapes -->
            <svg class="absolute top-20 right-[10%] w-32 h-32 opacity-[0.04]" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" stroke="#0078d4" stroke-width="1" fill="none"/>
                <circle cx="50" cy="50" r="30" stroke="#0078d4" stroke-width="1" fill="none"/>
                <circle cx="50" cy="50" r="20" stroke="#0078d4" stroke-width="1" fill="none"/>
            </svg>

            <svg class="absolute bottom-40 left-[15%] w-24 h-24 opacity-[0.04]" viewBox="0 0 100 100">
                <rect x="10" y="10" width="80" height="80" stroke="#5ea0ef" stroke-width="1" fill="none" transform="rotate(45 50 50)"/>
                <rect x="20" y="20" width="60" height="60" stroke="#5ea0ef" stroke-width="1" fill="none" transform="rotate(45 50 50)"/>
            </svg>

            <!-- Cloud SVG Illustrations -->
            <svg class="absolute top-32 left-[8%] w-20 h-20 text-primary-200/20 animate-float-1" viewBox="0 0 200 200">
                <path d="M140 110c15 0 27-12 27-27 0-13-9-24-22-26-2-26-24-47-50-47-18 0-35 10-43 25-4-2-8-2-13-2-19 0-35 15-35 35 0 3 1 6 1 9C8 79 1 91 1 104c0 17 14 31 31 31h108z" fill="currentColor"/>
            </svg>

            <svg class="absolute bottom-48 right-[12%] w-16 h-16 text-primary-100/30 animate-float-2" viewBox="0 0 200 200">
                <path d="M140 110c15 0 27-12 27-27 0-13-9-24-22-26-2-26-24-47-50-47-18 0-35 10-43 25-4-2-8-2-13-2-19 0-35 15-35 35 0 3 1 6 1 9C8 79 1 91 1 104c0 17 14 31 31 31h108z" fill="currentColor"/>
            </svg>

            <!-- Floating Elements -->
            <div class="absolute top-40 right-[20%] w-16 h-16 bg-gradient-to-br from-primary-100/50 to-primary-200/30 rounded-2xl border border-primary-200/40 animate-float-3 rotate-12"></div>
            <div class="absolute bottom-60 left-[25%] w-12 h-12 bg-gradient-to-br from-navy-100/50 to-navy-200/30 rounded-xl border border-navy-200/40 animate-float-4 -rotate-6"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20">
            <div class="text-center min-h-[calc(100vh-200px)] flex flex-col justify-center">
                <!-- Main Content -->
                <div
                    class="transition-all duration-1000 ease-out"
                    :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <!-- Badge -->
                    <div class="inline-flex items-center px-5 py-2.5 rounded-full bg-gradient-to-r from-primary-50 to-primary-100 border border-primary-200 mb-6 shadow-sm">
                        <span class="relative flex w-2.5 h-2.5 mr-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                        </span>
                        <span class="text-sm font-semibold text-primary-700">Your Azure Learning Journey Starts Here</span>
                    </div>

                    <!-- Heading -->
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        <span class="text-navy-900">Master </span>
                        <span class="relative inline-block">
                            <span class="relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-primary-600 via-primary-500 to-primary-700 animate-gradient">
                                Azure Cloud
                            </span>
                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-full h-3 bg-gradient-to-r from-primary-200/60 to-primary-300/60 blur-lg"></div>
                        </span>
                        <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-navy-800 to-navy-600">Hands-On</span>
                    </h1>

                    <!-- Description -->
                    <div class="relative mb-10">
                        <p class="text-lg sm:text-xl text-navy-600 leading-relaxed max-w-3xl mx-auto">
                            Dive deep into Azure with real-world projects, interactive labs, and comprehensive tutorials.
                            <span class="text-navy-900 font-semibold">Build practical skills</span> that employers demand.
                        </p>
                    </div>

                    <!-- Large Search Bar -->
                    <div class="max-w-3xl mx-auto mb-8">
                        <div class="relative">
                            <input 
                                v-model="searchQuery"
                                type="text" 
                                placeholder="Search tutorials, labs, Azure services..." 
                                class="w-full pl-14 pr-32 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-primary-500 focus:ring-4 focus:ring-primary-200 outline-none transition-all shadow-xl"
                                @keypress="handleKeyPress"
                            />
                            <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <button 
                                @click="handleSearch"
                                class="absolute right-3 top-1/2 -translate-y-1/2 px-6 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105"
                            >
                                Search
                            </button>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap justify-center gap-4 mb-12">
                        <a
                            href="/tutorials"
                            class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-white overflow-hidden rounded-xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-xl shadow-primary-600/30"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-primary-700"></div>
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-primary-500 to-primary-600"></div>
                            </div>
                            <span class="relative flex items-center">
                                Browse Tutorials
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </a>

                        <a
                            href="/support"
                            class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-primary-700 bg-white border-2 border-primary-200 hover:border-primary-400 hover:bg-primary-50 rounded-xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Get Support
                        </a>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 max-w-4xl mx-auto">
                        <div
                            v-for="(stat, index) in stats"
                            :key="stat.label"
                            class="relative group transition-all duration-700 ease-out"
                            :class="isVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            :style="{ transitionDelay: `${(index + 2) * 100}ms` }"
                        >
                            <div class="relative p-5 rounded-xl bg-gradient-to-br from-white to-primary-50/30 border-2 border-primary-200 hover:border-primary-400 hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <div class="text-3xl sm:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800 mb-1">{{ stat.value }}</div>
                                <div class="text-xs sm:text-sm text-navy-600 font-medium">{{ stat.label }}</div>
                            </div>
                        </div>
                    </div>
                </div>
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

@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
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

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}
</style>
