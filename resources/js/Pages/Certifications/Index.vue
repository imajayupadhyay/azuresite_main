<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import CertificationCard from './Components/CertificationCard.vue';

const props = defineProps({
    certifications: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
});

const selectedLevel = ref('all');
const isHeroVisible = ref(false);

onMounted(() => {
    setTimeout(() => isHeroVisible.value = true, 100);
});

const filteredCertifications = computed(() => {
    if (selectedLevel.value === 'all') {
        return props.certifications;
    }
    return props.certifications.filter(cert => cert.level === selectedLevel.value);
});
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-primary-50/30">
        <Head>
            <title>Azure Certifications - Microsoft Azure Exam Preparation | AzureSkill</title>
            <meta name="description" content="Prepare for 12 Microsoft Azure certifications including AZ-900, AZ-104, AZ-305. Complete exam guides, preparation resources, and learning paths for all levels." />
            <meta name="keywords" content="Azure certification, AZ-900, AZ-104, AZ-204, AZ-305, Microsoft certification, Azure exam preparation, cloud certification" />
        </Head>
        
        <Header />
        
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900">
            <!-- Animated Grid Background -->
            <div class="absolute inset-0">
                <svg class="absolute w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="cert-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#cert-grid)" />
                </svg>
            </div>

            <!-- Animated Orbs -->
            <div class="absolute top-10 left-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

            <!-- Floating Icons -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <!-- Certificate Badge -->
                <div class="absolute top-20 left-[15%] animate-float-slow">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20">
                        <svg class="w-6 h-6 text-yellow-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                </div>
                <!-- Checkmark Badge -->
                <div class="absolute top-32 right-[20%] animate-float-delayed">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/20">
                        <svg class="w-5 h-5 text-green-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <!-- Trophy -->
                <div class="absolute bottom-20 left-[25%] animate-float-slow" style="animation-delay: 2s;">
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20">
                        <svg class="w-7 h-7 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M5 3h14v2H5V3zm0 4h14a3 3 0 01-3 3h-2v4l3 3v1H7v-1l3-3v-4H8a3 3 0 01-3-3zm4 14h6v2H9v-2z"/>
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
                        <svg class="w-4 h-4 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                        <span class="text-sm text-primary-100">{{ props.certifications.length }} Certifications Available</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                        Azure
                        <span class="bg-gradient-to-r from-yellow-400 to-amber-400 bg-clip-text text-transparent">Certifications</span>
                    </h1>
                    <p class="text-lg text-primary-200/80 max-w-2xl mx-auto mb-10">
                        Choose your certification path and advance your career with Microsoft Azure certifications
                    </p>

                    <!-- Filter Tabs -->
                    <div class="inline-flex bg-white/10 backdrop-blur-sm rounded-2xl p-1.5 border border-white/20">
                        <button
                            @click="selectedLevel = 'all'"
                            class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300"
                            :class="selectedLevel === 'all'
                                ? 'bg-white text-navy-900 shadow-lg'
                                : 'text-white/80 hover:text-white hover:bg-white/10'"
                        >
                            All Certifications
                        </button>
                        <button
                            v-for="category in props.categories"
                            :key="category.slug"
                            @click="selectedLevel = category.slug"
                            class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300"
                            :class="selectedLevel === category.slug
                                ? 'bg-white text-navy-900 shadow-lg'
                                : 'text-white/80 hover:text-white hover:bg-white/10'"
                        >
                            {{ category.name }}
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Certifications Grid -->
        <div class="w-full px-6 lg:px-12 xl:px-20 py-12">
            <transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 translate-y-8"
                enter-to-class="opacity-100 translate-y-0"
                mode="out-in"
            >
                <div :key="selectedLevel" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <CertificationCard
                        v-for="(cert, index) in filteredCertifications"
                        :key="cert.code"
                        :certification="cert"
                        :index="index"
                    />
                </div>
            </transition>
        </div>

        <Footer />
    </div>
</template>

<style scoped>
@keyframes float-slow {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px) rotate(5deg); }
    50% { transform: translateY(-20px) rotate(-5deg); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 8s ease-in-out infinite;
    animation-delay: 1s;
}
</style>
