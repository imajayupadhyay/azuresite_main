<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
    certification: {
        type: Object,
        required: true
    }
});

const isHeroVisible = ref(false);
const activeTab = ref('overview');
const expandedFaq = ref(null);

onMounted(() => {
    setTimeout(() => isHeroVisible.value = true, 100);
});

const toggleFaq = (index) => {
    expandedFaq.value = expandedFaq.value === index ? null : index;
};

const levelColorClass = computed(() => {
    const colors = {
        green: 'from-green-500 to-emerald-500',
        blue: 'from-blue-500 to-cyan-500',
        purple: 'from-purple-500 to-pink-500',
        orange: 'from-orange-500 to-amber-500',
    };
    return colors[props.certification.levelColor] || colors.blue;
});

const levelBadgeClass = computed(() => {
    const colors = {
        green: 'bg-green-100 text-green-700 border-green-200',
        blue: 'bg-blue-100 text-blue-700 border-blue-200',
        purple: 'bg-purple-100 text-purple-700 border-purple-200',
        orange: 'bg-orange-100 text-orange-700 border-orange-200',
    };
    return colors[props.certification.levelColor] || colors.blue;
});

const tabs = [
    { id: 'overview', name: 'Overview', icon: 'info' },
    { id: 'curriculum', name: 'Curriculum', icon: 'book' },
    { id: 'skills', name: 'Skills Measured', icon: 'chart' },
    { id: 'resources', name: 'Resources', icon: 'link' },
    { id: 'faq', name: 'FAQ', icon: 'question' },
];
</script>

<template>
    <div class="min-h-screen bg-navy-50">
        <Head>
            <title>{{ certification.code }} - {{ certification.name }} | AzureSkill</title>
            <meta name="description" :content="certification.description" />
        </Head>

        <Header />

        <!-- Hero Section -->
        <section class="relative pt-24 sm:pt-32 pb-12 sm:pb-16 overflow-hidden bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900">
            <!-- Grid Background -->
            <div class="absolute inset-0">
                <svg class="absolute w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="cert-detail-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#cert-detail-grid)" />
                </svg>
            </div>

            <!-- Orbs -->
            <div class="hidden sm:block absolute top-10 left-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="hidden sm:block absolute bottom-10 right-10 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

            <div class="relative w-full px-4 sm:px-6 lg:px-12 xl:px-20">
                <div
                    class="max-w-5xl mx-auto transition-all duration-700"
                    :class="isHeroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <!-- Breadcrumb -->
                    <nav class="flex items-center text-xs sm:text-sm text-primary-200/70 mb-4 sm:mb-6">
                        <a href="/certifications" class="hover:text-white transition-colors">Certifications</a>
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mx-1 sm:mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-white">{{ certification.code }}</span>
                    </nav>

                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 lg:gap-12">
                        <!-- Left Content -->
                        <div class="flex-1">
                            <!-- Level Badge -->
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full border mb-4" :class="levelBadgeClass">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <span class="text-sm font-semibold">{{ certification.level }}</span>
                            </div>

                            <!-- Certification Code & Name -->
                            <div class="mb-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl sm:text-4xl lg:text-5xl font-black bg-gradient-to-r bg-clip-text text-transparent" :class="levelColorClass">
                                        {{ certification.code }}
                                    </span>
                                </div>
                                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">
                                    {{ certification.name }}
                                </h1>
                            </div>

                            <p class="text-sm sm:text-base text-primary-200/80 mb-6 max-w-2xl">
                                {{ certification.description }}
                            </p>

                            <!-- Quick Stats -->
                            <div class="flex flex-wrap gap-3 sm:gap-4">
                                <div class="flex items-center px-3 py-2 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20">
                                    <svg class="w-4 h-4 text-primary-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-primary-100">{{ certification.examDuration }}</span>
                                </div>
                                <div class="flex items-center px-3 py-2 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20">
                                    <svg class="w-4 h-4 text-primary-300 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <span class="text-sm text-primary-100">{{ certification.questions }} questions</span>
                                </div>
                                <div class="flex items-center px-3 py-2 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20">
                                    <svg class="w-4 h-4 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-primary-100">{{ certification.passingScore }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Card - Exam Details -->
                        <div class="lg:w-80 bg-white/10 backdrop-blur-sm rounded-2xl p-5 sm:p-6 border border-white/20">
                            <h3 class="font-bold text-white mb-4">Exam Details</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-primary-200/70">Exam Cost</span>
                                    <span class="text-white font-semibold">{{ certification.examCost }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-primary-200/70">Prep Time</span>
                                    <span class="text-white font-semibold">{{ certification.duration }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-primary-200/70">Last Updated</span>
                                    <span class="text-white font-semibold">{{ certification.lastUpdated }}</span>
                                </div>
                            </div>
                            <div class="mt-5 pt-5 border-t border-white/10">
                                <a
                                    href="/live-training"
                                    class="block w-full py-3 bg-gradient-to-r from-primary-600 to-blue-600 text-white font-semibold rounded-xl text-center hover:from-primary-500 hover:to-blue-500 transition-all text-sm"
                                >
                                    Start Preparation
                                </a>
                                <a
                                    href="#"
                                    class="block w-full py-3 mt-3 bg-white/10 text-white font-semibold rounded-xl text-center hover:bg-white/20 transition-all text-sm border border-white/20"
                                >
                                    Schedule Exam
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tab Navigation -->
        <div class="sticky top-0 z-30 bg-white border-b border-navy-100 shadow-sm">
            <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-20">
                <div class="max-w-5xl mx-auto">
                    <nav class="flex overflow-x-auto -mb-px">
                        <button
                            v-for="tab in tabs"
                            :key="tab.id"
                            @click="activeTab = tab.id"
                            class="flex items-center px-4 sm:px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition-colors"
                            :class="activeTab === tab.id
                                ? 'border-primary-500 text-primary-600'
                                : 'border-transparent text-navy-500 hover:text-navy-700 hover:border-navy-300'"
                        >
                            {{ tab.name }}
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-20 py-8 sm:py-12">
            <div class="max-w-5xl mx-auto">
                <!-- Overview Tab -->
                <div v-show="activeTab === 'overview'" class="space-y-8">
                    <!-- Description -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-navy-100">
                        <h2 class="text-xl font-bold text-navy-900 mb-4">About This Certification</h2>
                        <p class="text-navy-600 leading-relaxed">{{ certification.longDescription }}</p>
                    </div>

                    <!-- Two Column Layout -->
                    <div class="grid lg:grid-cols-2 gap-6">
                        <!-- Prerequisites -->
                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-navy-100">
                            <h3 class="text-lg font-bold text-navy-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Prerequisites
                            </h3>
                            <ul class="space-y-3">
                                <li v-for="(prereq, index) in certification.prerequisites" :key="index" class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-navy-600 text-sm">{{ prereq }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Target Audience -->
                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-navy-100">
                            <h3 class="text-lg font-bold text-navy-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Who Should Take This Exam
                            </h3>
                            <ul class="space-y-3">
                                <li v-for="(audience, index) in certification.targetAudience" :key="index" class="flex items-start">
                                    <svg class="w-5 h-5 text-primary-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-navy-600 text-sm">{{ audience }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="bg-gradient-to-br from-navy-900 via-primary-900 to-navy-900 rounded-2xl p-6 sm:p-8 text-center relative overflow-hidden">
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
                        <div class="relative z-10">
                            <h3 class="text-xl sm:text-2xl font-bold text-white mb-2">Ready to Get Certified?</h3>
                            <p class="text-primary-200 mb-6 max-w-lg mx-auto text-sm sm:text-base">
                                Join our live training sessions and get expert guidance to pass your exam on the first attempt.
                            </p>
                            <a href="/live-training" class="inline-flex items-center px-8 py-4 bg-white text-navy-900 font-semibold rounded-xl hover:bg-primary-50 transition-colors">
                                Start Your Preparation
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Curriculum Tab -->
                <div v-show="activeTab === 'curriculum'" class="space-y-6">
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-navy-100">
                        <h2 class="text-xl font-bold text-navy-900 mb-6">Course Curriculum</h2>
                        <div class="space-y-4">
                            <div
                                v-for="module in certification.modules"
                                :key="module.number"
                                class="border border-navy-100 rounded-xl overflow-hidden hover:border-primary-200 transition-colors"
                            >
                                <div class="bg-navy-50 px-5 py-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-blue-500 text-white flex items-center justify-center text-sm font-bold mr-4">
                                            {{ module.number }}
                                        </span>
                                        <div>
                                            <h3 class="font-semibold text-navy-900">{{ module.title }}</h3>
                                            <p class="text-xs text-navy-500">{{ module.duration }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-navy-500 bg-white px-3 py-1 rounded-full">{{ module.lessons.length }} lessons</span>
                                </div>
                                <div class="p-5">
                                    <ul class="space-y-2">
                                        <li v-for="(lesson, index) in module.lessons" :key="index" class="flex items-center text-sm text-navy-600">
                                            <svg class="w-4 h-4 text-primary-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ lesson }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills Measured Tab -->
                <div v-show="activeTab === 'skills'" class="space-y-6">
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-navy-100">
                        <h2 class="text-xl font-bold text-navy-900 mb-2">Skills Measured</h2>
                        <p class="text-navy-500 text-sm mb-6">These are the key areas covered in the exam and their approximate weightage.</p>

                        <div class="space-y-6">
                            <div
                                v-for="(skill, index) in certification.skills"
                                :key="index"
                                class="border border-navy-100 rounded-xl p-5 hover:border-primary-200 transition-colors"
                            >
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="font-semibold text-navy-900 flex-1">{{ skill.name }}</h3>
                                    <span class="px-3 py-1 bg-primary-50 text-primary-700 rounded-full text-sm font-medium ml-4">
                                        {{ skill.weight }}
                                    </span>
                                </div>

                                <!-- Progress Bar -->
                                <div class="h-2 bg-navy-100 rounded-full mb-4 overflow-hidden">
                                    <div
                                        class="h-full bg-gradient-to-r from-primary-500 to-blue-500 rounded-full"
                                        :style="{ width: skill.weight.split('-')[1] || skill.weight }"
                                    ></div>
                                </div>

                                <ul class="space-y-2">
                                    <li v-for="(topic, tIndex) in skill.topics" :key="tIndex" class="flex items-start text-sm text-navy-600">
                                        <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ topic }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources Tab -->
                <div v-show="activeTab === 'resources'" class="space-y-6">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <a
                            v-for="(resource, index) in certification.resources"
                            :key="index"
                            :href="resource.url"
                            target="_blank"
                            class="group bg-white rounded-2xl p-6 border border-navy-100 hover:border-primary-200 hover:shadow-lg transition-all duration-300"
                        >
                            <div class="flex items-start">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-blue-500 flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                    <svg v-if="resource.icon === 'microsoft'" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M11.4 24H0V12.6h11.4V24zM24 24H12.6V12.6H24V24zM11.4 11.4H0V0h11.4v11.4zm12.6 0H12.6V0H24v11.4z"/>
                                    </svg>
                                    <svg v-else-if="resource.icon === 'test'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                    <svg v-else-if="resource.icon === 'video'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <svg v-else class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-navy-900 group-hover:text-primary-600 transition-colors mb-1">
                                        {{ resource.title }}
                                    </h3>
                                    <p class="text-sm text-navy-500">{{ resource.description }}</p>
                                </div>
                                <svg class="w-5 h-5 text-navy-300 group-hover:text-primary-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- FAQ Tab -->
                <div v-show="activeTab === 'faq'" class="space-y-4">
                    <div
                        v-for="(faq, index) in certification.faqs"
                        :key="index"
                        class="bg-white rounded-2xl border border-navy-100 overflow-hidden"
                    >
                        <button
                            @click="toggleFaq(index)"
                            class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-navy-50 transition-colors"
                        >
                            <span class="font-semibold text-navy-900 pr-4">{{ faq.question }}</span>
                            <svg
                                class="w-5 h-5 text-navy-400 flex-shrink-0 transition-transform duration-300"
                                :class="{ 'rotate-180': expandedFaq === index }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="opacity-0 max-h-0"
                            enter-to-class="opacity-100 max-h-96"
                            leave-active-class="transition-all duration-200 ease-in"
                            leave-from-class="opacity-100 max-h-96"
                            leave-to-class="opacity-0 max-h-0"
                        >
                            <div v-show="expandedFaq === index" class="px-6 pb-5 overflow-hidden">
                                <p class="text-navy-600 text-sm leading-relaxed">{{ faq.answer }}</p>
                            </div>
                        </transition>
                    </div>
                </div>

                <!-- Related Certifications -->
                <div v-if="certification.relatedCertifications?.length" class="mt-12">
                    <h3 class="text-xl font-bold text-navy-900 mb-6">Related Certifications</h3>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a
                            v-for="related in certification.relatedCertifications"
                            :key="related.slug"
                            :href="`/certifications/${related.slug}`"
                            class="group bg-white rounded-xl p-5 border border-navy-100 hover:border-primary-200 hover:shadow-lg transition-all duration-300"
                        >
                            <div class="flex items-center mb-3">
                                <span class="text-2xl font-black bg-gradient-to-r from-primary-500 to-blue-500 bg-clip-text text-transparent mr-3">
                                    {{ related.code }}
                                </span>
                            </div>
                            <h4 class="font-semibold text-navy-900 group-hover:text-primary-600 transition-colors mb-2">{{ related.name }}</h4>
                            <span class="text-xs px-2 py-1 bg-navy-100 text-navy-600 rounded-full">{{ related.level }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <Footer />
    </div>
</template>
