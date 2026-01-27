<script setup>
import { ref } from 'vue';

const props = defineProps({
    selectedCategory: {
        type: String,
        required: true
    }
});

const emit = defineEmits(['category-change']);

const categories = [
    { 
        id: 'compute', 
        name: 'Compute', 
        icon: 'M19 12h-2M19 12a7 7 0 0 1-7 7m7-7a7 7 0 0 0-7-7m0 14a7 7 0 0 1-7-7m7 7v2m-7-9H3m4.5-5.5L5 5',
        count: 24,
        color: 'from-blue-500 to-blue-600'
    },
    { 
        id: 'storage', 
        name: 'Storage', 
        icon: 'M4 6h16M4 10h16M4 14h16M4 18h16',
        count: 16,
        color: 'from-orange-500 to-orange-600'
    },
    { 
        id: 'networking', 
        name: 'Networking', 
        icon: 'M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z',
        count: 14,
        color: 'from-cyan-500 to-cyan-600'
    },
    { 
        id: 'database', 
        name: 'Databases', 
        icon: 'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5',
        count: 22,
        color: 'from-red-500 to-red-600'
    },
    { 
        id: 'ai', 
        name: 'AI + ML', 
        icon: 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
        count: 19,
        color: 'from-purple-500 to-purple-600'
    },
    { 
        id: 'security', 
        name: 'Security', 
        icon: 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
        count: 16,
        color: 'from-yellow-500 to-yellow-600'
    },
    { 
        id: 'devops', 
        name: 'DevOps', 
        icon: 'M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6',
        count: 28,
        color: 'from-green-500 to-green-600'
    },
    { 
        id: 'web', 
        name: 'Web & Mobile', 
        icon: 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9',
        count: 15,
        color: 'from-indigo-500 to-indigo-600'
    }
];

const isSidebarOpen = ref(true);
</script>

<template>
    <aside class="w-80 flex-shrink-0">
        <!-- Sidebar Card -->
        <div class="sticky top-24 bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Sidebar Header -->
            <div class="p-6 bg-gradient-to-r from-primary-600 to-primary-700 text-white">
                <h2 class="text-xl font-bold mb-1">Categories</h2>
                <p class="text-sm text-primary-100">Browse tutorials by service type</p>
            </div>

            <!-- Categories List -->
            <div class="p-4">
                <nav class="space-y-2">
                    <button
                        v-for="category in categories"
                        :key="category.id"
                        @click="$emit('category-change', category.id)"
                        class="w-full group relative flex items-center justify-between p-4 rounded-xl transition-all duration-300"
                        :class="selectedCategory === category.id 
                            ? 'bg-gradient-to-r from-primary-50 to-primary-100 border-2 border-primary-300 shadow-md' 
                            : 'bg-gray-50 hover:bg-gray-100 border-2 border-transparent hover:border-gray-200'"
                    >
                        <!-- Left Content -->
                        <div class="flex items-center space-x-3">
                            <!-- Icon -->
                            <div 
                                class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-300"
                                :class="selectedCategory === category.id 
                                    ? 'bg-gradient-to-br ' + category.color + ' shadow-lg' 
                                    : 'bg-white border border-gray-200 group-hover:border-gray-300'"
                            >
                                <svg 
                                    class="w-5 h-5 transition-colors"
                                    :class="selectedCategory === category.id ? 'text-white' : 'text-gray-600 group-hover:text-gray-800'"
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="category.icon"/>
                                </svg>
                            </div>

                            <!-- Category Name -->
                            <div class="text-left">
                                <p 
                                    class="font-semibold transition-colors"
                                    :class="selectedCategory === category.id ? 'text-primary-700' : 'text-gray-700 group-hover:text-gray-900'"
                                >
                                    {{ category.name }}
                                </p>
                                <p class="text-xs text-gray-500">{{ category.count }} tutorials</p>
                            </div>
                        </div>

                        <!-- Arrow Indicator -->
                        <svg 
                            v-if="selectedCategory === category.id"
                            class="w-5 h-5 text-primary-600" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                        <svg 
                            v-else
                            class="w-5 h-5 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </nav>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-6 bg-gradient-to-br from-primary-50 to-navy-50 border-t border-gray-200">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-navy-900">200+ Tutorials</p>
                        <p class="text-xs text-navy-600">Constantly updated</p>
                    </div>
                </div>
                <a 
                    href="/labs" 
                    class="block w-full text-center px-4 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105 shadow-lg"
                >
                    Start Learning
                </a>
            </div>
        </div>
    </aside>
</template>
