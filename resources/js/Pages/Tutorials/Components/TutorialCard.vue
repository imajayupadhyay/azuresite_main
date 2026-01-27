<script setup>
const props = defineProps({
    tutorial: {
        type: Object,
        required: true
    },
    index: {
        type: Number,
        default: 0
    }
});

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
                <div class="w-14 h-14 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </div>
                <div 
                    class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold border backdrop-blur-sm"
                    :class="getDifficultyColor(tutorial.level)"
                >
                    {{ tutorial.level }}
                </div>
            </div>

            <!-- Tutorial Title -->
            <h3 class="text-xl font-bold text-navy-900 mb-3 group-hover:text-primary-600 transition-colors leading-tight line-clamp-2">
                {{ tutorial.title }}
            </h3>

            <!-- Stats -->
            <div class="grid grid-cols-2 gap-2 mb-4">
                <div class="bg-primary-50/50 backdrop-blur-sm px-3 py-2 rounded-lg">
                    <p class="text-xs text-navy-600">Duration</p>
                    <div class="flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm font-bold text-primary-600">{{ tutorial.duration }}</p>
                    </div>
                </div>
                <div class="bg-primary-50/50 backdrop-blur-sm px-3 py-2 rounded-lg">
                    <p class="text-xs text-navy-600">Rating</p>
                    <div class="flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        <p class="text-sm font-bold text-primary-600">{{ tutorial.rating }}</p>
                    </div>
                </div>
            </div>

            <!-- Students -->
            <div class="flex items-center text-sm text-navy-600 mb-4 bg-primary-50/50 backdrop-blur-sm px-3 py-2 rounded-lg">
                <svg class="w-4 h-4 mr-1.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="font-medium">{{ tutorial.students.toLocaleString() }} students enrolled</span>
            </div>

            <!-- CTA Button -->
            <button class="w-full px-4 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-xl transition-all duration-300 group-hover:scale-105 flex items-center justify-center shadow-lg">
                <span>Start Tutorial</span>
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </button>
        </div>
    </div>
</template>
