<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const isHeroVisible = ref(false);
const currentStep = ref(1);
const selectedCategory = ref(null);
const selectedItems = ref([]);
const isSubmitted = ref(false);
const formData = ref({
    name: '',
    email: '',
    phone: '',
    experience: '',
    preferredTime: '',
    message: ''
});

onMounted(() => {
    setTimeout(() => isHeroVisible.value = true, 100);
});

const categories = [
    {
        id: 'certification',
        title: 'Certification Training',
        subtitle: 'Get Certified',
        description: 'Prepare for Azure certifications with expert guidance and pass on your first attempt',
        icon: 'certification',
        color: 'from-blue-500 to-cyan-500',
        bgColor: 'bg-blue-500/20',
        items: [
            { name: 'AZ-900', description: 'Azure Fundamentals', level: 'Fundamental' },
            { name: 'AZ-104', description: 'Azure Administrator', level: 'Associate' },
            { name: 'AZ-204', description: 'Azure Developer', level: 'Associate' },
            { name: 'AZ-305', description: 'Solutions Architect', level: 'Expert' },
            { name: 'AZ-500', description: 'Security Engineer', level: 'Associate' },
            { name: 'AZ-400', description: 'DevOps Engineer', level: 'Expert' },
            { name: 'DP-203', description: 'Data Engineer', level: 'Associate' },
            { name: 'AI-102', description: 'AI Engineer', level: 'Associate' }
        ]
    },
    {
        id: 'project',
        title: 'Project-Based Training',
        subtitle: 'Learn by Doing',
        description: 'Build real-world Azure projects with hands-on mentorship',
        icon: 'project',
        color: 'from-emerald-500 to-green-500',
        bgColor: 'bg-emerald-500/20',
        items: [
            { name: 'E-Commerce Platform', description: 'Full-stack online store', duration: '8 weeks' },
            { name: 'IoT Dashboard', description: 'Connected device platform', duration: '6 weeks' },
            { name: 'Data Analytics Pipeline', description: 'Big data processing', duration: '10 weeks' },
            { name: 'Serverless API', description: 'Event-driven backend', duration: '5 weeks' },
            { name: 'Microservices App', description: 'Distributed architecture', duration: '12 weeks' },
            { name: 'CI/CD Pipeline', description: 'Complete DevOps setup', duration: '7 weeks' }
        ]
    },
    {
        id: 'services',
        title: 'Azure Services Deep Dive',
        subtitle: 'Master Services',
        description: 'Deep dive into specific Azure services with expert instructors',
        icon: 'services',
        color: 'from-purple-500 to-pink-500',
        bgColor: 'bg-purple-500/20',
        items: [
            { name: 'Virtual Machines', description: 'IaaS compute mastery' },
            { name: 'App Service', description: 'PaaS web hosting' },
            { name: 'Azure Functions', description: 'Serverless computing' },
            { name: 'Kubernetes (AKS)', description: 'Container orchestration' },
            { name: 'SQL Database', description: 'Managed databases' },
            { name: 'Cosmos DB', description: 'NoSQL at scale' },
            { name: 'Azure AD / Entra', description: 'Identity management' },
            { name: 'Key Vault', description: 'Secrets & encryption' }
        ]
    }
];

const selectCategory = (categoryId) => {
    selectedCategory.value = categoryId;
    selectedItems.value = [];
    currentStep.value = 2;
};

const toggleItem = (item) => {
    const index = selectedItems.value.findIndex(i => i.name === item.name);
    if (index > -1) {
        selectedItems.value.splice(index, 1);
    } else {
        selectedItems.value.push(item);
    }
};

const isItemSelected = (item) => {
    return selectedItems.value.some(i => i.name === item.name);
};

const goToForm = () => {
    if (selectedItems.value.length > 0) {
        currentStep.value = 3;
    }
};

const submitForm = () => {
    isSubmitted.value = true;
    setTimeout(() => {
        currentStep.value = 1;
        selectedCategory.value = null;
        selectedItems.value = [];
        isSubmitted.value = false;
        formData.value = { name: '', email: '', phone: '', experience: '', preferredTime: '', message: '' };
    }, 3000);
};

const goBack = () => {
    if (currentStep.value > 1) {
        currentStep.value--;
        if (currentStep.value === 1) {
            selectedCategory.value = null;
            selectedItems.value = [];
        }
    }
};

const selectedCategoryData = computed(() => {
    return categories.find(c => c.id === selectedCategory.value);
});

const steps = [
    { num: 1, label: 'Choose Path' },
    { num: 2, label: 'Select Topics' },
    { num: 3, label: 'Register' }
];
</script>

<template>
    <div class="min-h-screen bg-navy-950">
        <Head>
            <title>Live Training - Interactive Azure Learning | AzureSkill</title>
            <meta name="description" content="Join our live Azure training sessions. Choose from certification preparation, project-based learning, or specific Azure services training." />
        </Head>

        <Header />

        <!-- Hero Section -->
        <section class="relative pt-20 pb-8 overflow-hidden bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900">
            <!-- Animated Background -->
            <div class="absolute inset-0">
                <svg class="absolute w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="training-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#training-grid)" />
                </svg>
            </div>

            <!-- Animated Orbs -->
            <div class="absolute top-10 left-10 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary-500/10 rounded-full blur-3xl"></div>

            <!-- Floating Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-24 left-[10%] animate-float-slow">
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20 rotate-12">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-32 right-[15%] animate-float-delayed">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20 -rotate-6">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute bottom-20 left-[20%] animate-float-slow" style="animation-delay: 1.5s;">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/20 rotate-6">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="relative w-full px-6 lg:px-12 xl:px-20">
                <div
                    class="text-center transition-all duration-700"
                    :class="isHeroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                >
                    <!-- Badge -->
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-6">
                        <span class="relative flex h-2 w-2 mr-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
                        </span>
                        <span class="text-sm text-primary-100">Live Interactive Sessions</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                        Live
                        <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">Azure</span>
                        Training
                    </h1>
                    <p class="text-lg text-primary-200/80 max-w-2xl mx-auto mb-8">
                        Choose your learning path, select topics, and get personalized training from Azure experts
                    </p>
                </div>
            </div>
        </section>

        <!-- Step Indicator -->
        <div class="sticky top-16 z-40 bg-navy-900/95 backdrop-blur-lg border-b border-white/10">
            <div class="w-full px-6 lg:px-12 xl:px-20 py-4">
                <div class="flex items-center justify-center gap-4 sm:gap-8">
                    <template v-for="(step, index) in steps" :key="step.num">
                        <div class="flex items-center">
                            <div
                                class="flex items-center justify-center w-10 h-10 rounded-full font-bold text-sm transition-all duration-300"
                                :class="currentStep >= step.num
                                    ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white shadow-lg shadow-purple-500/30'
                                    : 'bg-white/10 text-white/50'"
                            >
                                <svg v-if="currentStep > step.num" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span v-else>{{ step.num }}</span>
                            </div>
                            <span
                                class="ml-3 text-sm font-medium hidden sm:block transition-colors"
                                :class="currentStep >= step.num ? 'text-white' : 'text-white/50'"
                            >
                                {{ step.label }}
                            </span>
                        </div>
                        <div
                            v-if="index < steps.length - 1"
                            class="w-12 sm:w-20 h-1 rounded-full transition-all duration-500"
                            :class="currentStep > step.num ? 'bg-gradient-to-r from-blue-500 to-purple-500' : 'bg-white/10'"
                        ></div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="w-full px-6 lg:px-12 xl:px-20 py-12">
            <!-- Step 1: Choose Category -->
            <transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 translate-y-8"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-all duration-300 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="currentStep === 1" class="max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Choose Your Learning Path</h2>
                        <p class="text-lg text-primary-200/70">Select how you want to learn Azure</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- Certification Card -->
                        <div
                            @click="selectCategory('certification')"
                            class="group relative cursor-pointer"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-3xl opacity-0 group-hover:opacity-50 transition-opacity duration-500 blur-xl"></div>
                            <div class="relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 group-hover:bg-white/10 group-hover:border-blue-500/50 transition-all duration-500 group-hover:-translate-y-2 h-full">
                                <div class="w-16 h-16 rounded-2xl bg-blue-500/20 flex items-center justify-center mb-6 transition-transform duration-300 group-hover:scale-110">
                                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white">
                                    Get Certified
                                </span>
                                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors duration-300">
                                    Certification Training
                                </h3>
                                <p class="text-primary-200/70 mb-6">Prepare for Azure certifications with expert guidance and pass on your first attempt</p>
                                <div class="flex items-center font-semibold text-blue-400">
                                    <span>Get Started</span>
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card -->
                        <div
                            @click="selectCategory('project')"
                            class="group relative cursor-pointer"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-green-500 rounded-3xl opacity-0 group-hover:opacity-50 transition-opacity duration-500 blur-xl"></div>
                            <div class="relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 group-hover:bg-white/10 group-hover:border-emerald-500/50 transition-all duration-500 group-hover:-translate-y-2 h-full">
                                <div class="w-16 h-16 rounded-2xl bg-emerald-500/20 flex items-center justify-center mb-6 transition-transform duration-300 group-hover:scale-110">
                                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-3 bg-gradient-to-r from-emerald-500 to-green-500 text-white">
                                    Learn by Doing
                                </span>
                                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors duration-300">
                                    Project-Based Training
                                </h3>
                                <p class="text-primary-200/70 mb-6">Build real-world Azure projects with hands-on mentorship</p>
                                <div class="flex items-center font-semibold text-emerald-400">
                                    <span>Get Started</span>
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Services Card -->
                        <div
                            @click="selectCategory('services')"
                            class="group relative cursor-pointer"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-3xl opacity-0 group-hover:opacity-50 transition-opacity duration-500 blur-xl"></div>
                            <div class="relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 group-hover:bg-white/10 group-hover:border-purple-500/50 transition-all duration-500 group-hover:-translate-y-2 h-full">
                                <div class="w-16 h-16 rounded-2xl bg-purple-500/20 flex items-center justify-center mb-6 transition-transform duration-300 group-hover:scale-110">
                                    <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mb-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                                    Master Services
                                </span>
                                <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors duration-300">
                                    Azure Services Deep Dive
                                </h3>
                                <p class="text-primary-200/70 mb-6">Deep dive into specific Azure services with expert instructors</p>
                                <div class="flex items-center font-semibold text-purple-400">
                                    <span>Get Started</span>
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <!-- Step 2: Select Items -->
            <transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 translate-y-8"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-all duration-300 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="currentStep === 2 && selectedCategoryData" class="max-w-6xl mx-auto">
                    <!-- Back Button -->
                    <button
                        @click="goBack"
                        class="inline-flex items-center text-primary-200/70 hover:text-white font-medium mb-8 transition-colors"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to Categories
                    </button>

                    <div class="text-center mb-12">
                        <div
                            class="inline-flex w-20 h-20 rounded-2xl items-center justify-center mb-4"
                            :class="selectedCategoryData.bgColor"
                        >
                            <svg v-if="selectedCategoryData.icon === 'certification'" class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            <svg v-else-if="selectedCategoryData.icon === 'project'" class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <svg v-else class="w-10 h-10 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">{{ selectedCategoryData.title }}</h2>
                        <p class="text-lg text-primary-200/70">Select the topics you want to learn (multiple selection allowed)</p>
                    </div>

                    <!-- Items Grid -->
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
                        <div
                            v-for="item in selectedCategoryData.items"
                            :key="item.name"
                            @click="toggleItem(item)"
                            class="group relative cursor-pointer"
                        >
                            <div
                                class="relative p-6 rounded-2xl border transition-all duration-300 hover:-translate-y-1"
                                :class="isItemSelected(item)
                                    ? 'bg-gradient-to-br from-white/15 to-white/5 border-white/30 shadow-xl'
                                    : 'bg-white/5 border-white/10 hover:bg-white/10 hover:border-white/20'"
                            >
                                <!-- Checkbox -->
                                <div
                                    class="absolute top-4 right-4 w-6 h-6 rounded-lg border-2 flex items-center justify-center transition-all"
                                    :class="isItemSelected(item)
                                        ? 'bg-gradient-to-r from-blue-500 to-purple-500 border-transparent'
                                        : 'border-white/30 group-hover:border-white/50'"
                                >
                                    <svg v-if="isItemSelected(item)" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>

                                <!-- Content -->
                                <h4
                                    class="text-lg font-bold mb-2 transition-colors pr-8"
                                    :class="isItemSelected(item) ? 'text-white' : 'text-white/90 group-hover:text-white'"
                                >
                                    {{ item.name }}
                                </h4>
                                <p class="text-sm text-primary-200/60 mb-3">{{ item.description }}</p>

                                <!-- Badge -->
                                <span
                                    v-if="item.level"
                                    class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold"
                                    :class="{
                                        'bg-blue-500/20 text-blue-300': item.level === 'Fundamental',
                                        'bg-green-500/20 text-green-300': item.level === 'Associate',
                                        'bg-purple-500/20 text-purple-300': item.level === 'Expert'
                                    }"
                                >
                                    {{ item.level }}
                                </span>
                                <span
                                    v-if="item.duration"
                                    class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-500/20 text-amber-300"
                                >
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ item.duration }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Continue Button -->
                    <div class="text-center">
                        <p class="text-sm text-primary-200/60 mb-4">{{ selectedItems.length }} topic(s) selected</p>
                        <button
                            @click="goToForm"
                            :disabled="selectedItems.length === 0"
                            class="px-10 py-4 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-400 hover:to-purple-400 disabled:from-white/10 disabled:to-white/10 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 disabled:scale-100 disabled:cursor-not-allowed shadow-lg shadow-purple-500/25 disabled:shadow-none"
                        >
                            Continue to Registration
                        </button>
                    </div>
                </div>
            </transition>

            <!-- Step 3: Form -->
            <transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 translate-y-8"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-all duration-300 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="currentStep === 3 && !isSubmitted" class="max-w-3xl mx-auto">
                    <!-- Back Button -->
                    <button
                        @click="goBack"
                        class="inline-flex items-center text-primary-200/70 hover:text-white font-medium mb-8 transition-colors"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to Topics
                    </button>

                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl overflow-hidden">
                        <!-- Form Header -->
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 px-8 py-6">
                            <h2 class="text-2xl font-bold text-white mb-2">Complete Your Registration</h2>
                            <p class="text-white/80">We'll contact you within 24 hours</p>
                        </div>

                        <!-- Selected Items -->
                        <div class="px-8 py-6 border-b border-white/10">
                            <h3 class="text-sm font-semibold text-white/70 mb-3">Your Selected Topics:</h3>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    v-for="item in selectedItems"
                                    :key="item.name"
                                    class="inline-flex items-center px-3 py-1.5 bg-white/10 border border-white/20 text-white text-sm font-medium rounded-lg"
                                >
                                    {{ item.name }}
                                </span>
                            </div>
                        </div>

                        <!-- Form -->
                        <form @submit.prevent="submitForm" class="p-8 space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-white/80 mb-2">Full Name *</label>
                                    <input
                                        v-model="formData.name"
                                        type="text"
                                        required
                                        placeholder="John Doe"
                                        class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-white/30 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20 outline-none transition-all"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-white/80 mb-2">Email Address *</label>
                                    <input
                                        v-model="formData.email"
                                        type="email"
                                        required
                                        placeholder="john@example.com"
                                        class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-white/30 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20 outline-none transition-all"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-white/80 mb-2">Phone Number *</label>
                                    <input
                                        v-model="formData.phone"
                                        type="tel"
                                        required
                                        placeholder="+1 234 567 8900"
                                        class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-white/30 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20 outline-none transition-all"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-white/80 mb-2">Azure Experience *</label>
                                    <select
                                        v-model="formData.experience"
                                        required
                                        class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20 outline-none transition-all"
                                    >
                                        <option value="" class="bg-navy-900">Select your level</option>
                                        <option value="beginner" class="bg-navy-900">Beginner (0-6 months)</option>
                                        <option value="intermediate" class="bg-navy-900">Intermediate (6 months - 2 years)</option>
                                        <option value="advanced" class="bg-navy-900">Advanced (2+ years)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-white/80 mb-2">Preferred Training Time *</label>
                                <select
                                    v-model="formData.preferredTime"
                                    required
                                    class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20 outline-none transition-all"
                                >
                                    <option value="" class="bg-navy-900">Select preferred time</option>
                                    <option value="weekday-morning" class="bg-navy-900">Weekday Morning (9 AM - 12 PM)</option>
                                    <option value="weekday-afternoon" class="bg-navy-900">Weekday Afternoon (2 PM - 5 PM)</option>
                                    <option value="weekday-evening" class="bg-navy-900">Weekday Evening (6 PM - 9 PM)</option>
                                    <option value="weekend" class="bg-navy-900">Weekend Sessions</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-white/80 mb-2">Additional Message</label>
                                <textarea
                                    v-model="formData.message"
                                    rows="4"
                                    placeholder="Tell us about your learning goals..."
                                    class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-white/30 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/20 outline-none transition-all resize-none"
                                ></textarea>
                            </div>

                            <button
                                type="submit"
                                class="w-full px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-400 hover:to-purple-400 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-[1.02] shadow-lg shadow-purple-500/25"
                            >
                                Submit Registration
                            </button>
                        </form>
                    </div>
                </div>
            </transition>

            <!-- Success State -->
            <transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
            >
                <div v-if="isSubmitted" class="max-w-lg mx-auto text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">Registration Successful!</h2>
                    <p class="text-lg text-primary-200/70 mb-8">Thank you for your interest. Our team will contact you within 24 hours.</p>
                    <div class="flex items-center justify-center gap-2 text-primary-200/50">
                        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span>Redirecting...</span>
                    </div>
                </div>
            </transition>
        </div>

        <Footer />
    </div>
</template>

<style scoped>
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(12deg); }
    50% { transform: translateY(-20px) rotate(12deg); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px) rotate(-6deg); }
    50% { transform: translateY(-15px) rotate(-6deg); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 8s ease-in-out infinite;
    animation-delay: 1s;
}
</style>
