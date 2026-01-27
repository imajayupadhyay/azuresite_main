<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const isVisible = ref(false);
const currentSlide = ref(0);
let slideInterval = null;

const slides = [
    {
        image: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=1920&q=80',
        title: 'Master Azure Cloud',
        subtitle: 'Learn Microsoft Azure with hands-on tutorials and expert guidance',
    },
    {
        image: 'https://images.unsplash.com/photo-1504639725590-34d0984388bd?w=1920&q=80',
        title: 'Get Certified',
        subtitle: 'Prepare for Azure certifications from Foundation to Expert level',
    },
    {
        image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1920&q=80',
        title: '200+ Tutorials',
        subtitle: 'Comprehensive guides covering all Azure services and best practices',
    },
];

const nextSlide = () => {
    currentSlide.value = (currentSlide.value + 1) % slides.length;
};

const prevSlide = () => {
    currentSlide.value = (currentSlide.value - 1 + slides.length) % slides.length;
};

const goToSlide = (index) => {
    currentSlide.value = index;
};

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
    
    // Auto-advance slides every 5 seconds
    slideInterval = setInterval(nextSlide, 5000);
});

onUnmounted(() => {
    if (slideInterval) {
        clearInterval(slideInterval);
    }
});
</script>

<template>
    <section class="relative min-h-screen overflow-hidden bg-navy-900">
        <!-- Slides -->
        <div class="absolute inset-0">
            <transition-group
                enter-active-class="transition-opacity duration-1000"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-opacity duration-1000"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-for="(slide, index) in slides"
                    :key="index"
                    v-show="currentSlide === index"
                    class="absolute inset-0"
                >
                    <!-- Background Image -->
                    <img 
                        :src="slide.image" 
                        :alt="slide.title"
                        class="w-full h-full object-cover"
                    />
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-navy-900/90 via-navy-900/70 to-primary-900/80"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-transparent to-transparent"></div>
                </div>
            </transition-group>
        </div>

        <!-- Content -->
        <div class="relative h-screen flex items-center justify-center">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <transition
                    enter-active-class="transition-all duration-1000 ease-out"
                    enter-from-class="opacity-0 translate-y-8"
                    enter-to-class="opacity-100 translate-y-0"
                    mode="out-in"
                >
                    <div :key="currentSlide" class="space-y-6">
                        <!-- Title -->
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight">
                            {{ slides[currentSlide].title }}
                        </h1>
                        
                        <!-- Subtitle -->
                        <p class="text-xl sm:text-2xl text-primary-100 max-w-3xl mx-auto mb-8">
                            {{ slides[currentSlide].subtitle }}
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-wrap justify-center gap-4 mt-8">
                            <a
                                href="/tutorials"
                                class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-navy-900 overflow-hidden rounded-xl transition-all duration-300 hover:scale-105 active:scale-95 shadow-2xl"
                            >
                                <div class="absolute inset-0 bg-white"></div>
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-r from-primary-100 to-white"></div>
                                </div>
                                <span class="relative flex items-center">
                                    Explore Tutorials
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </span>
                            </a>

                            <a
                                href="/certifications"
                                class="group relative inline-flex items-center px-8 py-4 text-base font-semibold text-white overflow-hidden rounded-xl transition-all duration-300 hover:scale-105 active:scale-95"
                            >
                                <div class="absolute inset-0 bg-white/10 backdrop-blur-lg border-2 border-white/30"></div>
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/20"></div>
                                <span class="relative flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                    Get Certified
                                </span>
                            </a>
                        </div>
                    </div>
                </transition>
            </div>
        </div>

        <!-- Slide Indicators -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 z-10">
            <button
                v-for="(slide, index) in slides"
                :key="index"
                @click="goToSlide(index)"
                class="transition-all duration-300"
                :class="currentSlide === index 
                    ? 'w-12 h-3 bg-white rounded-full' 
                    : 'w-3 h-3 bg-white/40 hover:bg-white/60 rounded-full'"
            ></button>
        </div>
    </section>
</template>

<style scoped>
/* Remove all old animations, keep only these if needed */
</style>
