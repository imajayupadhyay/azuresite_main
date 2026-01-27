<script setup>
const props = defineProps({
    certification: {
        type: Object,
        required: true
    },
    index: {
        type: Number,
        default: 0
    }
});

const getBadgeUrl = (level) => {
    const badges = {
        'foundation': 'https://learn.microsoft.com/media/learn/certification/badges/microsoft-certified-fundamentals-badge.svg',
        'associate': 'https://learn.microsoft.com/media/learn/certification/badges/microsoft-certified-associate-badge.svg',
        'expert': 'https://learn.microsoft.com/media/learn/certification/badges/microsoft-certified-expert-badge.svg'
    };
    return badges[level] || badges['foundation'];
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
    <div
        class="group relative bg-white/70 backdrop-blur-xl rounded-2xl border-2 border-primary-200 hover:border-primary-400 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
        :style="{ transitionDelay: `${index * 50}ms` }"
    >
        <!-- Glass Effect Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 to-white/50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        <!-- Card Content -->
        <div class="relative">
            <!-- Header -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <!-- Azure Badge -->
                    <div class="w-16 h-16 bg-white rounded-xl border-2 border-primary-200 flex items-center justify-center shadow-lg p-2 group-hover:scale-110 transition-transform duration-300">
                        <img 
                            :src="getBadgeUrl(certification.level)" 
                            :alt="`${certification.name} Badge`"
                            class="w-full h-full object-contain"
                        />
                    </div>
                    <div>
                        <div class="text-lg font-bold text-primary-600">{{ certification.code }}</div>
                        <div 
                            class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold border mt-1 backdrop-blur-sm"
                            :class="getDifficultyColor(certification.difficulty)"
                        >
                            {{ certification.difficulty }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certification Name -->
            <h3 class="text-xl font-bold text-navy-900 mb-3 group-hover:text-primary-600 transition-colors leading-tight">
                {{ certification.name }}
            </h3>

            <!-- Description -->
            <p class="text-sm text-navy-600 mb-4 leading-relaxed line-clamp-3">
                {{ certification.description }}
            </p>

            <!-- Skills -->
            <div class="mb-4">
                <p class="text-xs font-semibold text-navy-700 mb-2">Key Skills:</p>
                <div class="flex flex-wrap gap-2">
                    <span
                        v-for="skill in certification.skills.slice(0, 3)"
                        :key="skill"
                        class="px-2.5 py-1 bg-primary-50 text-primary-700 text-xs font-medium rounded-lg border border-primary-200"
                    >
                        {{ skill }}
                    </span>
                    <span
                        v-if="certification.skills.length > 3"
                        class="px-2.5 py-1 bg-gray-50 text-gray-600 text-xs font-medium rounded-lg border border-gray-200"
                    >
                        +{{ certification.skills.length - 3 }}
                    </span>
                </div>
            </div>

            <!-- Exam Info -->
            <div class="grid grid-cols-3 gap-2 mb-4">
                <div class="bg-primary-50/50 backdrop-blur-sm px-3 py-2 rounded-lg text-center">
                    <p class="text-xs text-navy-600">Duration</p>
                    <p class="text-sm font-bold text-primary-600">{{ certification.examLength }}</p>
                </div>
                <div class="bg-primary-50/50 backdrop-blur-sm px-3 py-2 rounded-lg text-center">
                    <p class="text-xs text-navy-600">Questions</p>
                    <p class="text-sm font-bold text-primary-600">{{ certification.questions }}</p>
                </div>
                <div class="bg-primary-50/50 backdrop-blur-sm px-3 py-2 rounded-lg text-center">
                    <p class="text-xs text-navy-600">Pass Score</p>
                    <p class="text-sm font-bold text-primary-600">{{ certification.passingScore }}</p>
                </div>
            </div>

            <!-- Prep Time -->
            <div class="flex items-center text-sm text-navy-600 mb-4 bg-primary-50/50 backdrop-blur-sm px-3 py-2 rounded-lg">
                <svg class="w-4 h-4 mr-1.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ certification.duration }} prep time</span>
            </div>

            <!-- CTA Button -->
            <button class="w-full px-4 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-xl transition-all duration-300 group-hover:scale-105 flex items-center justify-center shadow-lg">
                <span>Start Preparation</span>
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </button>
        </div>
    </div>
</template>
