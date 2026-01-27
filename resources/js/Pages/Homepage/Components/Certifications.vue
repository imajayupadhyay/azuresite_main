<script setup>
import { ref } from 'vue';

const activeTab = ref('foundation');
const scrollContainer = ref(null);

const scrollLeft = () => {
    if (scrollContainer.value) {
        scrollContainer.value.scrollBy({ left: -400, behavior: 'smooth' });
    }
};

const scrollRight = () => {
    if (scrollContainer.value) {
        scrollContainer.value.scrollBy({ left: 400, behavior: 'smooth' });
    }
};

const certifications = {
    foundation: [
        { 
            code: 'AZ-900', 
            name: 'Azure Fundamentals',
            description: 'Foundational knowledge of cloud services',
            duration: '1-2 months',
            difficulty: 'Beginner',
            icon: '🎯'
        },
        { 
            code: 'AI-900', 
            name: 'AI Fundamentals',
            description: 'Introduction to artificial intelligence',
            duration: '1 month',
            difficulty: 'Beginner',
            icon: '🤖'
        },
        { 
            code: 'DP-900', 
            name: 'Data Fundamentals',
            description: 'Core data concepts in Azure',
            duration: '1 month',
            difficulty: 'Beginner',
            icon: '📊'
        },
        { 
            code: 'SC-900', 
            name: 'Security Fundamentals',
            description: 'Security, compliance, and identity',
            duration: '1 month',
            difficulty: 'Beginner',
            icon: '🔒'
        }
    ],
    associate: [
        { 
            code: 'AZ-104', 
            name: 'Azure Administrator',
            description: 'Implement and manage Azure resources',
            duration: '3-4 months',
            difficulty: 'Intermediate',
            icon: '⚙️'
        },
        { 
            code: 'AZ-204', 
            name: 'Azure Developer',
            description: 'Design and build cloud solutions',
            duration: '3-4 months',
            difficulty: 'Intermediate',
            icon: '💻'
        },
        { 
            code: 'AZ-500', 
            name: 'Azure Security Engineer',
            description: 'Implement security controls',
            duration: '3-4 months',
            difficulty: 'Intermediate',
            icon: '🛡️'
        },
        { 
            code: 'DP-203', 
            name: 'Azure Data Engineer',
            description: 'Design and implement data solutions',
            duration: '3-4 months',
            difficulty: 'Intermediate',
            icon: '📈'
        },
        { 
            code: 'AI-102', 
            name: 'Azure AI Engineer',
            description: 'Design and implement AI solutions',
            duration: '3-4 months',
            difficulty: 'Intermediate',
            icon: '🧠'
        },
        { 
            code: 'AZ-400', 
            name: 'DevOps Engineer',
            description: 'Design and implement DevOps practices',
            duration: '3-4 months',
            difficulty: 'Intermediate',
            icon: '🔄'
        }
    ],
    expert: [
        { 
            code: 'AZ-305', 
            name: 'Azure Solutions Architect',
            description: 'Design infrastructure solutions',
            duration: '4-6 months',
            difficulty: 'Advanced',
            icon: '🏗️'
        },
        { 
            code: 'AZ-801', 
            name: 'Windows Server Hybrid',
            description: 'Configure hybrid solutions',
            duration: '4-6 months',
            difficulty: 'Advanced',
            icon: '🌐'
        },
        { 
            code: 'SC-100', 
            name: 'Cybersecurity Architect',
            description: 'Design cybersecurity solutions',
            duration: '4-6 months',
            difficulty: 'Advanced',
            icon: '🔐'
        }
    ]
};

const getDifficultyColor = (difficulty) => {
    const colors = {
        'Beginner': 'bg-green-100 text-green-700 border-green-200',
        'Intermediate': 'bg-yellow-100 text-yellow-700 border-yellow-200',
        'Advanced': 'bg-red-100 text-red-700 border-red-200'
    };
    return colors[difficulty] || 'bg-gray-100 text-gray-700';
};
</script>

<template>
    <section class="relative py-20 bg-gradient-to-br from-gray-50 to-primary-50/30 overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <svg class="absolute top-20 right-[10%] w-32 h-32 opacity-[0.03]" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" stroke="#0078d4" stroke-width="1" fill="none"/>
                <circle cx="50" cy="50" r="30" stroke="#0078d4" stroke-width="1" fill="none"/>
            </svg>
            <div class="absolute bottom-20 left-[15%] w-64 h-64 bg-gradient-to-br from-primary-100/20 to-primary-200/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-primary-50 to-primary-100 border border-primary-200 mb-4">
                    <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <span class="text-sm font-semibold text-primary-700">Get Certified</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-bold text-navy-900 mb-4">
                    Azure Certifications
                </h2>
                <p class="text-lg text-navy-600 max-w-2xl mx-auto">
                    Choose your path and advance your career with Microsoft Azure certifications
                </p>
            </div>

            <!-- Tabs -->
            <div class="flex justify-center mb-10">
                <div class="inline-flex bg-white/80 backdrop-blur-lg rounded-2xl p-2 shadow-xl border-2 border-primary-200">
                    <button
                        @click="activeTab = 'foundation'"
                        class="px-8 py-3 rounded-xl font-semibold text-sm transition-all duration-300"
                        :class="activeTab === 'foundation' 
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg' 
                            : 'text-navy-600 hover:text-navy-900 hover:bg-primary-50'"
                    >
                        Foundation
                    </button>
                    <button
                        @click="activeTab = 'associate'"
                        class="px-8 py-3 rounded-xl font-semibold text-sm transition-all duration-300"
                        :class="activeTab === 'associate' 
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg' 
                            : 'text-navy-600 hover:text-navy-900 hover:bg-primary-50'"
                    >
                        Associate
                    </button>
                    <button
                        @click="activeTab = 'expert'"
                        class="px-8 py-3 rounded-xl font-semibold text-sm transition-all duration-300"
                        :class="activeTab === 'expert' 
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg' 
                            : 'text-navy-600 hover:text-navy-900 hover:bg-primary-50'"
                    >
                        Expert
                    </button>
                </div>
            </div>

            <!-- Certifications Slider -->
            <div class="relative">
                <!-- Navigation Buttons -->
                <button
                    @click="scrollLeft"
                    class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-12 h-12 bg-white/90 backdrop-blur-lg hover:bg-white rounded-full shadow-xl border-2 border-primary-200 hover:border-primary-400 transition-all duration-300 hover:scale-110 flex items-center justify-center group"
                >
                    <svg class="w-6 h-6 text-primary-600 group-hover:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <button
                    @click="scrollRight"
                    class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-12 h-12 bg-white/90 backdrop-blur-lg hover:bg-white rounded-full shadow-xl border-2 border-primary-200 hover:border-primary-400 transition-all duration-300 hover:scale-110 flex items-center justify-center group"
                >
                    <svg class="w-6 h-6 text-primary-600 group-hover:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Scrollable Container -->
                <transition
                    enter-active-class="transition-all duration-500 ease-out"
                    enter-from-class="opacity-0 translate-y-8"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition-all duration-300 ease-in"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 -translate-y-8"
                    mode="out-in"
                >
                    <div 
                        :key="activeTab" 
                        ref="scrollContainer"
                        class="flex gap-6 overflow-x-auto scroll-smooth pb-4 scrollbar-hide"
                        style="scroll-snap-type: x mandatory;"
                    >
                        <div
                            v-for="(cert, index) in certifications[activeTab]"
                            :key="cert.code"
                            class="group relative bg-white/70 backdrop-blur-xl rounded-2xl border-2 border-primary-200 hover:border-primary-400 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 flex-shrink-0 w-[380px]"
                            style="scroll-snap-align: start;"
                            :style="{ transitionDelay: `${index * 50}ms` }"
                        >
                        <!-- Glass Effect Background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 to-white/50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Certification Header -->
                        <div class="relative flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <!-- Azure Badge -->
                                <div class="w-16 h-16 bg-white rounded-xl border-2 border-primary-200 flex items-center justify-center shadow-lg p-2 group-hover:scale-110 transition-transform duration-300">
                                    <img 
                                        src="https://learn.microsoft.com/media/learn/certification/badges/microsoft-certified-fundamentals-badge.svg" 
                                        alt="Azure Badge"
                                        class="w-full h-full object-contain"
                                        v-if="activeTab === 'foundation'"
                                    />
                                    <img 
                                        src="https://learn.microsoft.com/media/learn/certification/badges/microsoft-certified-associate-badge.svg" 
                                        alt="Azure Badge"
                                        class="w-full h-full object-contain"
                                        v-else-if="activeTab === 'associate'"
                                    />
                                    <img 
                                        src="https://learn.microsoft.com/media/learn/certification/badges/microsoft-certified-expert-badge.svg" 
                                        alt="Azure Badge"
                                        class="w-full h-full object-contain"
                                        v-else
                                    />
                                </div>
                                <div>
                                    <div class="text-lg font-bold text-primary-600">{{ cert.code }}</div>
                                    <div 
                                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold border mt-1 backdrop-blur-sm"
                                        :class="getDifficultyColor(cert.difficulty)"
                                    >
                                        {{ cert.difficulty }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Certification Name -->
                        <h3 class="relative text-xl font-bold text-navy-900 mb-2 group-hover:text-primary-600 transition-colors">
                            {{ cert.name }}
                        </h3>

                        <!-- Description -->
                        <p class="relative text-sm text-navy-600 mb-4 leading-relaxed">
                            {{ cert.description }}
                        </p>

                        <!-- Duration -->
                        <div class="relative flex items-center text-sm text-navy-600 mb-4 bg-primary-50/50 backdrop-blur-sm px-3 py-2 rounded-lg">
                            <svg class="w-4 h-4 mr-1.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">{{ cert.duration }} prep time</span>
                        </div>

                        <!-- CTA Button -->
                        <button class="relative w-full px-4 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-xl transition-all duration-300 group-hover:scale-105 flex items-center justify-center shadow-lg">
                            <span>Start Preparation</span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* Hide scrollbar for Chrome, Safari and Opera */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.scrollbar-hide {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
