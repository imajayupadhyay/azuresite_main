<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import { useAzureIcons } from '@/Composables/useAzureIcons';

const { getIcon } = useAzureIcons();

// Get the icon SVG from the identifier
const serviceIcon = computed(() => {
    if (props.service.iconIdentifier) {
        const icon = getIcon(props.service.iconIdentifier);
        return icon?.svg || null;
    }
    return null;
});

const props = defineProps({
    service: {
        type: Object,
        required: true
    }
});

const isHeroVisible = ref(false);
const activeSection = ref('');
const showVideoModal = ref(false);
const isScrolled = ref(false);
const showMobileToc = ref(false);
const showCopiedToast = ref(false);

onMounted(() => {
    setTimeout(() => isHeroVisible.value = true, 100);

    // Intersection Observer for TOC highlighting
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    activeSection.value = entry.target.id;
                }
            });
        },
        { rootMargin: '-100px 0px -70% 0px' }
    );

    // Observe all sections
    props.service.sections?.forEach((section) => {
        const element = document.getElementById(section.id);
        if (element) observer.observe(element);
    });

    // Scroll listener for sticky TOC
    const handleScroll = () => {
        isScrolled.value = window.scrollY > 400;
    };
    window.addEventListener('scroll', handleScroll);

    onUnmounted(() => {
        observer.disconnect();
        window.removeEventListener('scroll', handleScroll);
    });
});

const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        const offset = 100;
        const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
        window.scrollTo({ top: elementPosition - offset, behavior: 'smooth' });
        showMobileToc.value = false;
    }
};

const shareOnTwitter = () => {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(`Learn ${props.service.name} on Azure - ${props.service.description}`);
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
};

const shareOnLinkedIn = () => {
    const url = encodeURIComponent(window.location.href);
    window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank');
};

const copyLink = async () => {
    await navigator.clipboard.writeText(window.location.href);
    showCopiedToast.value = true;
    setTimeout(() => showCopiedToast.value = false, 2000);
};

const readingTime = computed(() => {
    const wordCount = props.service.sections?.reduce((total, section) => {
        return total + section.content.split(' ').length;
    }, 0) || 0;
    return Math.ceil(wordCount / 200);
});

const currentSectionTitle = computed(() => {
    const section = props.service.sections?.find(s => s.id === activeSection.value);
    return section?.title || 'Contents';
});
</script>

<template>
    <div class="min-h-screen bg-navy-50 dark:bg-navy-950">
        <Head>
            <title>{{ service.metaTitle || `${service.name} - Azure Tutorial | AzureSkill` }}</title>
            <meta name="description" :content="service.metaDescription || service.description" />
            <meta name="keywords" :content="`Azure ${service.name}, ${service.name} tutorial, Azure cloud, ${service.category}`" />
            <!-- Open Graph / Social Media -->
            <meta property="og:title" :content="service.metaTitle || `${service.name} - Azure Tutorial`" />
            <meta property="og:description" :content="service.metaDescription || service.description" />
            <meta property="og:type" content="article" />
            <!-- Twitter -->
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:title" :content="service.metaTitle || `${service.name} - Azure Tutorial`" />
            <meta name="twitter:description" :content="service.metaDescription || service.description" />
        </Head>

        <Header />

        <!-- Hero Section - Clean & Simple -->
        <section class="relative pt-24 sm:pt-32 pb-12 sm:pb-16 overflow-hidden bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900">
            <!-- Grid Background -->
            <div class="absolute inset-0">
                <svg class="absolute w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="service-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#service-grid)" />
                </svg>
            </div>

            <!-- Orbs - Hidden on very small screens for performance -->
            <div class="hidden sm:block absolute top-10 left-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="hidden sm:block absolute bottom-10 right-10 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

            <div class="relative w-full px-4 sm:px-6 lg:px-12 xl:px-20">
                <div
                    class="max-w-4xl mx-auto transition-all duration-700"
                    :class="isHeroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <!-- Breadcrumb - Simplified on mobile -->
                    <nav class="flex items-center text-xs sm:text-sm text-primary-200/70 mb-4 sm:mb-6 overflow-x-auto whitespace-nowrap pb-2">
                        <a href="/tutorials" class="hover:text-white transition-colors flex-shrink-0">Tutorials</a>
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mx-1 sm:mx-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-primary-100 hidden sm:inline flex-shrink-0">{{ service.category }}</span>
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mx-1 sm:mx-2 hidden sm:block flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-white flex-shrink-0">{{ service.name }}</span>
                    </nav>

                    <!-- Service Icon & Title -->
                    <div class="flex items-start sm:items-center mb-4 sm:mb-6">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center mr-3 sm:mr-5 flex-shrink-0">
                            <div v-if="serviceIcon" class="w-7 h-7 sm:w-10 sm:h-10" v-html="serviceIcon"></div>
                            <svg v-else class="w-6 h-6 sm:w-8 sm:h-8 text-primary-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                                {{ service.name }}
                            </h1>
                        </div>
                    </div>

                    <p class="text-sm sm:text-base lg:text-lg text-primary-200/80 mb-6 sm:mb-8 max-w-2xl">
                        {{ service.description }}
                    </p>

                    <!-- Meta Info - Scrollable on mobile -->
                    <div class="flex items-center gap-2 sm:gap-4 text-xs sm:text-sm overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap">
                        <div class="flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex-shrink-0">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-primary-300 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-primary-100">{{ readingTime }} min</span>
                        </div>
                        <div class="flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex-shrink-0">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-400 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-primary-100">{{ service.difficulty }}</span>
                        </div>
                        <div class="flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex-shrink-0">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-yellow-400 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <span class="text-primary-100">{{ service.tutorials }} tutorials</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Video Section -->
        <section class="w-full px-4 sm:px-6 lg:px-12 xl:px-20 -mt-6 sm:-mt-8 relative z-10">
            <div class="max-w-4xl mx-auto">
                <div
                    @click="showVideoModal = true"
                    class="group relative rounded-xl sm:rounded-2xl overflow-hidden cursor-pointer shadow-2xl shadow-navy-900/20 border border-navy-200 dark:border-navy-700"
                >
                    <!-- Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-navy-800 to-navy-900 relative">
                        <img
                            v-if="service.videoThumbnail"
                            :src="service.videoThumbnail"
                            :alt="`${service.name} video tutorial`"
                            class="w-full h-full object-cover"
                        />
                        <div v-else class="absolute inset-0 flex items-center justify-center">
                            <!-- Placeholder pattern -->
                            <div class="absolute inset-0 opacity-20">
                                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="video-pattern" width="20" height="20" patternUnits="userSpaceOnUse">
                                            <circle cx="2" cy="2" r="1" fill="white"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#video-pattern)" />
                                </svg>
                            </div>
                            <!-- Azure Logo Placeholder -->
                            <svg class="w-20 h-20 sm:w-32 sm:h-32 text-white/20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M5.483 21.003H24L14.025 4.164l-3.038 8.218 5.578 4.882H7.874l-2.39 3.739zM0 19.508l5.483-9.725 3.165-5.62H.001L0 19.508z"/>
                            </svg>
                        </div>

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-navy-950/40 group-hover:bg-navy-950/30 transition-colors"></div>

                        <!-- Play Button -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-14 h-14 sm:w-20 sm:h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:scale-110 group-hover:bg-white/30 transition-all duration-300">
                                <div class="w-11 h-11 sm:w-16 sm:h-16 rounded-full bg-gradient-to-r from-primary-600 to-blue-600 flex items-center justify-center shadow-lg shadow-primary-500/30">
                                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-white ml-0.5 sm:ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Video Label -->
                        <div class="absolute bottom-2 left-2 sm:bottom-4 sm:left-4 flex items-center px-2 py-1 sm:px-3 sm:py-1.5 rounded-lg bg-navy-950/80 backdrop-blur-sm">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                            </svg>
                            <span class="text-xs sm:text-sm text-white font-medium">Watch Tutorial</span>
                            <span class="text-xs sm:text-sm text-white/60 ml-1.5 sm:ml-2">{{ service.videoDuration || '15:30' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mobile TOC Toggle Button -->
        <button
            @click="showMobileToc = !showMobileToc"
            class="lg:hidden fixed bottom-4 right-4 z-40 w-14 h-14 bg-gradient-to-r from-primary-600 to-blue-600 rounded-full shadow-lg shadow-primary-500/30 flex items-center justify-center text-white"
        >
            <svg v-if="!showMobileToc" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
            </svg>
            <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Mobile TOC Drawer -->
        <Teleport to="body">
            <transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-all duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="showMobileToc" class="lg:hidden fixed inset-0 z-50">
                    <!-- Backdrop -->
                    <div class="absolute inset-0 bg-navy-950/60 backdrop-blur-sm" @click="showMobileToc = false"></div>

                    <!-- Drawer -->
                    <transition
                        enter-active-class="transition-transform duration-300 ease-out"
                        enter-from-class="translate-y-full"
                        enter-to-class="translate-y-0"
                        leave-active-class="transition-transform duration-200 ease-in"
                        leave-from-class="translate-y-0"
                        leave-to-class="translate-y-full"
                    >
                        <div v-if="showMobileToc" class="absolute bottom-0 left-0 right-0 bg-white dark:bg-navy-800 rounded-t-3xl max-h-[70vh] overflow-hidden">
                            <!-- Handle -->
                            <div class="flex justify-center py-3">
                                <div class="w-10 h-1 bg-navy-200 dark:bg-navy-600 rounded-full"></div>
                            </div>

                            <!-- Header -->
                            <div class="px-6 pb-3 border-b border-navy-100 dark:border-navy-700">
                                <h3 class="font-bold text-navy-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                    Table of Contents
                                </h3>
                            </div>

                            <!-- Sections -->
                            <nav class="p-4 overflow-y-auto max-h-[50vh]">
                                <div class="space-y-1">
                                    <button
                                        v-for="section in service.sections"
                                        :key="section.id"
                                        @click="scrollToSection(section.id)"
                                        class="w-full text-left px-4 py-3 rounded-xl text-sm transition-all duration-200 flex items-center"
                                        :class="activeSection === section.id
                                            ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 font-medium'
                                            : 'text-navy-600 dark:text-navy-300 hover:bg-navy-50 dark:hover:bg-navy-700'"
                                    >
                                        <span class="w-6 h-6 rounded-lg bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">
                                            {{ service.sections.indexOf(section) + 1 }}
                                        </span>
                                        {{ section.title }}
                                    </button>
                                </div>
                            </nav>

                            <!-- Share Buttons -->
                            <div class="p-4 border-t border-navy-100 dark:border-navy-700">
                                <p class="text-xs text-navy-500 dark:text-navy-400 mb-3">Share this tutorial</p>
                                <div class="flex gap-2">
                                    <button
                                        @click="shareOnTwitter"
                                        class="flex-1 p-3 rounded-xl bg-navy-50 dark:bg-navy-700 hover:bg-[#1DA1F2] hover:text-white text-navy-600 dark:text-navy-300 transition-all duration-300"
                                    >
                                        <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                    </button>
                                    <button
                                        @click="shareOnLinkedIn"
                                        class="flex-1 p-3 rounded-xl bg-navy-50 dark:bg-navy-700 hover:bg-[#0A66C2] hover:text-white text-navy-600 dark:text-navy-300 transition-all duration-300"
                                    >
                                        <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </button>
                                    <button
                                        @click="copyLink"
                                        class="flex-1 p-3 rounded-xl bg-navy-50 dark:bg-navy-700 hover:bg-primary-500 hover:text-white text-navy-600 dark:text-navy-300 transition-all duration-300"
                                    >
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </transition>
        </Teleport>

        <!-- Copied Toast -->
        <transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-2"
        >
            <div v-if="showCopiedToast" class="fixed bottom-20 left-1/2 -translate-x-1/2 z-50 px-4 py-2 bg-navy-900 text-white text-sm rounded-full shadow-lg">
                Link copied to clipboard!
            </div>
        </transition>

        <!-- Main Content Area -->
        <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-20 py-8 sm:py-12 lg:py-16">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-4 gap-8 lg:gap-12">
                    <!-- Table of Contents - Sticky Sidebar (Desktop Only) -->
                    <aside class="hidden lg:block lg:col-span-1">
                        <div
                            class="lg:sticky lg:top-24 space-y-6"
                            :class="{ 'animate-fade-in': isScrolled }"
                        >
                            <!-- TOC Card -->
                            <div class="bg-white dark:bg-navy-800 rounded-2xl p-6 border border-navy-100 dark:border-navy-700 shadow-sm">
                                <h3 class="font-bold text-navy-900 dark:text-white mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                    Contents
                                </h3>
                                <nav class="space-y-1">
                                    <button
                                        v-for="section in service.sections"
                                        :key="section.id"
                                        @click="scrollToSection(section.id)"
                                        class="w-full text-left px-3 py-2 rounded-lg text-sm transition-all duration-200"
                                        :class="activeSection === section.id
                                            ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 font-medium border-l-2 border-primary-500'
                                            : 'text-navy-600 dark:text-navy-300 hover:bg-navy-50 dark:hover:bg-navy-700 hover:text-navy-900 dark:hover:text-white'"
                                    >
                                        {{ section.title }}
                                    </button>
                                </nav>
                            </div>

                            <!-- Share Card -->
                            <div class="bg-white dark:bg-navy-800 rounded-2xl p-6 border border-navy-100 dark:border-navy-700 shadow-sm">
                                <h3 class="font-bold text-navy-900 dark:text-white mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                    Share
                                </h3>
                                <div class="flex gap-2">
                                    <button
                                        @click="shareOnTwitter"
                                        class="flex-1 p-3 rounded-xl bg-navy-50 dark:bg-navy-700 hover:bg-[#1DA1F2] hover:text-white text-navy-600 dark:text-navy-300 transition-all duration-300 group"
                                    >
                                        <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                    </button>
                                    <button
                                        @click="shareOnLinkedIn"
                                        class="flex-1 p-3 rounded-xl bg-navy-50 dark:bg-navy-700 hover:bg-[#0A66C2] hover:text-white text-navy-600 dark:text-navy-300 transition-all duration-300"
                                    >
                                        <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </button>
                                    <button
                                        @click="copyLink"
                                        class="flex-1 p-3 rounded-xl bg-navy-50 dark:bg-navy-700 hover:bg-primary-500 hover:text-white text-navy-600 dark:text-navy-300 transition-all duration-300"
                                    >
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Quick CTA -->
                            <div class="bg-gradient-to-br from-primary-600 to-blue-600 rounded-2xl p-6 text-white">
                                <h3 class="font-bold mb-2">Need Live Training?</h3>
                                <p class="text-sm text-primary-100 mb-4">Get personalized guidance from Azure experts.</p>
                                <a
                                    href="/live-training"
                                    class="block w-full py-3 bg-white text-primary-600 font-semibold rounded-xl text-center hover:bg-primary-50 transition-colors text-sm"
                                >
                                    Join Live Session
                                </a>
                            </div>
                        </div>
                    </aside>

                    <!-- Content Area -->
                    <main class="lg:col-span-3">
                        <article class="bg-white dark:bg-navy-800 rounded-2xl sm:rounded-3xl border border-navy-100 dark:border-navy-700 shadow-sm overflow-hidden">
                            <div class="p-5 sm:p-8 lg:p-12">
                                <!-- Content Sections -->
                                <div class="prose prose-sm sm:prose-base lg:prose-lg max-w-none">
                                    <section
                                        v-for="section in service.sections"
                                        :key="section.id"
                                        :id="section.id"
                                        class="mb-8 sm:mb-12 scroll-mt-24 sm:scroll-mt-28"
                                    >
                                        <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-navy-900 dark:text-white mb-3 sm:mb-4 flex items-start sm:items-center">
                                            <span class="w-6 h-6 sm:w-8 sm:h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300 flex items-center justify-center text-xs sm:text-sm font-bold mr-2 sm:mr-3 flex-shrink-0 mt-0.5 sm:mt-0">
                                                {{ service.sections.indexOf(section) + 1 }}
                                            </span>
                                            <span>{{ section.title }}</span>
                                        </h2>

                                        <div class="text-navy-600 dark:text-navy-300 leading-relaxed space-y-3 sm:space-y-4 text-sm sm:text-base" v-html="section.content"></div>

                                        <!-- Code Block (if exists) -->
                                        <div v-if="section.code" class="mt-4 sm:mt-6 rounded-lg sm:rounded-xl overflow-hidden -mx-5 sm:mx-0">
                                            <div class="bg-navy-900 px-3 sm:px-4 py-2 flex items-center justify-between">
                                                <span class="text-xs sm:text-sm text-navy-400">{{ section.codeLanguage || 'bash' }}</span>
                                                <button class="text-xs text-navy-400 hover:text-white transition-colors">Copy</button>
                                            </div>
                                            <pre class="bg-navy-950 p-3 sm:p-4 overflow-x-auto"><code class="text-xs sm:text-sm text-green-400">{{ section.code }}</code></pre>
                                        </div>

                                        <!-- Tip Box (if exists) -->
                                        <div v-if="section.tip" class="mt-4 sm:mt-6 p-3 sm:p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg sm:rounded-xl flex">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-amber-500 flex-shrink-0 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                            </svg>
                                            <div>
                                                <p class="font-semibold text-amber-800 dark:text-amber-300 mb-1 text-sm sm:text-base">Pro Tip</p>
                                                <p class="text-amber-700 dark:text-amber-400 text-xs sm:text-sm">{{ section.tip }}</p>
                                            </div>
                                        </div>

                                        <!-- Warning Box (if exists) -->
                                        <div v-if="section.warning" class="mt-4 sm:mt-6 p-3 sm:p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg sm:rounded-xl flex">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500 flex-shrink-0 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                            <div>
                                                <p class="font-semibold text-red-800 dark:text-red-300 mb-1 text-sm sm:text-base">Warning</p>
                                                <p class="text-red-700 dark:text-red-400 text-xs sm:text-sm">{{ section.warning }}</p>
                                            </div>
                                        </div>

                                        <!-- Images (if exist) -->
                                        <div v-if="section.images?.length" class="mt-4 sm:mt-6 space-y-4">
                                            <figure
                                                v-for="(image, index) in section.images"
                                                :key="index"
                                                class="rounded-lg sm:rounded-xl overflow-hidden border border-navy-100 dark:border-navy-700"
                                            >
                                                <img
                                                    :src="image.path"
                                                    :alt="image.alt || 'Tutorial image'"
                                                    class="w-full h-auto"
                                                />
                                                <figcaption
                                                    v-if="image.caption"
                                                    class="text-xs sm:text-sm text-navy-500 dark:text-navy-400 bg-navy-50 dark:bg-navy-800 px-3 sm:px-4 py-2 text-center"
                                                >
                                                    {{ image.caption }}
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </section>
                                </div>

                                <!-- Bottom CTA -->
                                <div class="mt-8 sm:mt-12 p-5 sm:p-8 bg-gradient-to-br from-navy-900 via-primary-900 to-navy-900 rounded-xl sm:rounded-2xl relative overflow-hidden">
                                    <!-- Pattern -->
                                    <div class="absolute inset-0 opacity-10">
                                        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <pattern id="cta-dots" width="20" height="20" patternUnits="userSpaceOnUse">
                                                    <circle cx="2" cy="2" r="1" fill="white"/>
                                                </pattern>
                                            </defs>
                                            <rect width="100%" height="100%" fill="url(#cta-dots)" />
                                        </svg>
                                    </div>

                                    <div class="relative z-10 text-center">
                                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white mb-2 sm:mb-3">Ready to Master {{ service.name }}?</h3>
                                        <p class="text-sm sm:text-base text-primary-200 mb-4 sm:mb-6 max-w-lg mx-auto">
                                            Get hands-on experience with our live training sessions and certification preparation courses.
                                        </p>
                                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                                            <a
                                                href="/live-training"
                                                class="px-6 sm:px-8 py-3 sm:py-4 bg-white text-navy-900 font-semibold rounded-xl hover:bg-primary-50 transition-colors text-sm sm:text-base"
                                            >
                                                Join Live Training
                                            </a>
                                            <a
                                                href="/certifications"
                                                class="px-6 sm:px-8 py-3 sm:py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl border border-white/20 hover:bg-white/20 transition-colors text-sm sm:text-base"
                                            >
                                                Get Certified
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Related Services -->
                        <div v-if="service.relatedServices?.length" class="mt-8 sm:mt-12">
                            <h3 class="text-lg sm:text-xl font-bold text-navy-900 dark:text-white mb-4 sm:mb-6">Related Tutorials</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                                <a
                                    v-for="related in service.relatedServices"
                                    :key="related.slug"
                                    :href="`/tutorials/${related.slug}`"
                                    class="group bg-white dark:bg-navy-800 rounded-xl p-4 sm:p-5 border border-navy-100 dark:border-navy-700 hover:border-primary-200 dark:hover:border-primary-800 hover:shadow-lg transition-all duration-300"
                                >
                                    <div class="flex items-center mb-2 sm:mb-3">
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-primary-50 dark:bg-primary-900/30 flex items-center justify-center mr-2 sm:mr-3 group-hover:bg-primary-100 dark:group-hover:bg-primary-900/50 transition-colors">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <h4 class="font-semibold text-sm sm:text-base text-navy-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">{{ related.name }}</h4>
                                    </div>
                                    <p class="text-xs sm:text-sm text-navy-500 dark:text-navy-400">{{ related.tutorials }} tutorials</p>
                                </a>
                            </div>
                        </div>

                        <!-- Mobile CTA Card -->
                        <div class="lg:hidden mt-8 bg-gradient-to-br from-primary-600 to-blue-600 rounded-2xl p-5 text-white">
                            <h3 class="font-bold mb-2">Need Live Training?</h3>
                            <p class="text-sm text-primary-100 mb-4">Get personalized guidance from Azure experts.</p>
                            <a
                                href="/live-training"
                                class="block w-full py-3 bg-white text-primary-600 font-semibold rounded-xl text-center hover:bg-primary-50 transition-colors text-sm"
                            >
                                Join Live Session
                            </a>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- Video Modal -->
        <Teleport to="body">
            <transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-all duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="showVideoModal" class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4">
                    <!-- Backdrop -->
                    <div class="absolute inset-0 bg-navy-950/90 backdrop-blur-sm" @click="showVideoModal = false"></div>

                    <!-- Modal Content -->
                    <div class="relative w-full max-w-5xl">
                        <button
                            @click="showVideoModal = false"
                            class="absolute -top-10 sm:-top-12 right-0 text-white/80 hover:text-white transition-colors"
                        >
                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <div class="aspect-video bg-navy-900 rounded-xl sm:rounded-2xl overflow-hidden shadow-2xl">
                            <iframe
                                v-if="service.videoUrl"
                                :src="service.videoUrl"
                                class="w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                            <div v-else class="w-full h-full flex items-center justify-center text-white/60">
                                <div class="text-center px-4">
                                    <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm sm:text-base">Video coming soon</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </Teleport>

        <Footer />
    </div>
</template>

<style scoped>
@reference "../../../css/app.css";

.prose h2 {
    @apply text-navy-900 dark:text-white;
}

.prose p {
    @apply text-navy-600 dark:text-navy-300;
}

.prose ul {
    @apply text-navy-600 dark:text-navy-300 space-y-2;
}

.prose li {
    @apply relative pl-6;
}

.prose li::before {
    content: '';
    @apply absolute left-0 top-2.5 w-2 h-2 bg-primary-500 rounded-full;
}

.prose code {
    @apply bg-navy-100 dark:bg-navy-700 px-2 py-0.5 rounded text-primary-700 dark:text-primary-300 text-sm font-mono;
}

.prose a {
    @apply text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 underline;
}

@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
