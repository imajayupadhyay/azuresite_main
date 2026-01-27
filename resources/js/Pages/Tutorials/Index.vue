<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import TutorialSidebar from './Components/TutorialSidebar.vue';
import TutorialGrid from './Components/TutorialGrid.vue';

const page = usePage();
const selectedCategory = ref('compute');
const searchQuery = ref('');

// Check if there's a search query in the URL
onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    if (searchParam) {
        searchQuery.value = searchParam;
    }
});

const handleCategoryChange = (category) => {
    selectedCategory.value = category;
};

const handleSearch = (query) => {
    searchQuery.value = query;
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-primary-50/30">
        <Header />
        
        <!-- Page Header -->
        <div class="relative pt-24 pb-12 bg-white overflow-hidden border-b border-gray-200">
            <!-- Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <!-- Subtle Gradient Orbs -->
                <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-gradient-to-br from-primary-100/40 to-primary-200/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-gradient-to-tr from-primary-50/60 to-navy-100/30 rounded-full blur-3xl"></div>
                
                <!-- Dotted Pattern -->
                <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="tutorials-dots" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1" fill="#1e293b"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#tutorials-dots)"/>
                </svg>

                <!-- Geometric Shapes -->
                <svg class="absolute top-32 right-[15%] w-24 h-24 opacity-[0.04]" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" stroke="#0078d4" stroke-width="1" fill="none"/>
                    <circle cx="50" cy="50" r="30" stroke="#0078d4" stroke-width="1" fill="none"/>
                </svg>

                <!-- Cloud SVG -->
                <svg class="absolute top-40 left-[10%] w-16 h-16 text-primary-200/20" viewBox="0 0 200 200">
                    <path d="M140 110c15 0 27-12 27-27 0-13-9-24-22-26-2-26-24-47-50-47-18 0-35 10-43 25-4-2-8-2-13-2-19 0-35 15-35 35 0 3 1 6 1 9C8 79 1 91 1 104c0 17 14 31 31 31h108z" fill="currentColor"/>
                </svg>

                <!-- Floating Elements -->
                <div class="absolute top-48 right-[25%] w-12 h-12 bg-gradient-to-br from-primary-100/50 to-primary-200/30 rounded-xl border border-primary-200/40 animate-float-1 rotate-12"></div>
                <div class="absolute bottom-32 left-[20%] w-10 h-10 bg-gradient-to-br from-navy-100/50 to-navy-200/30 rounded-lg border border-navy-200/40 animate-float-2 -rotate-6"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div class="text-center lg:text-left">
                        <!-- Badge -->
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-primary-50 to-primary-100 border border-primary-200 mb-4">
                            <svg class="w-4 h-4 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            <span class="text-sm font-semibold text-primary-700">200+ Tutorials Available</span>
                        </div>

                        <h1 class="text-4xl font-bold text-navy-900 mb-2">Azure Tutorials</h1>
                        <p class="text-lg text-navy-600">Master Azure services with our comprehensive step-by-step guides</p>
                    </div>
                    <div class="w-full lg:w-auto">
                        <div class="relative">
                            <input 
                                type="text" 
                                v-model="searchQuery"
                                placeholder="Search tutorials..." 
                                class="w-full lg:w-96 pl-12 pr-10 py-3.5 text-lg border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-200 outline-none transition-all shadow-lg"
                                @input="handleSearch(searchQuery)"
                            />
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <button
                                v-if="searchQuery"
                                @click="searchQuery = ''"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
            <div class="flex gap-8">
                <!-- Sidebar -->
                <TutorialSidebar 
                    :selected-category="selectedCategory"
                    @category-change="handleCategoryChange"
                />
                
                <!-- Tutorial Grid -->
                <TutorialGrid 
                    :category="selectedCategory" 
                    :search-query="searchQuery"
                    @clear-search="searchQuery = ''"
                />
            </div>
        </div>

        <Footer />
    </div>
</template>

<style scoped>
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

.animate-float-1 {
    animation: float-1 20s ease-in-out infinite;
}

.animate-float-2 {
    animation: float-2 18s ease-in-out infinite;
}
</style>
