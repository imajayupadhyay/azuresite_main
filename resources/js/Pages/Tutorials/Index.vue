<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage, Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import TutorialCard from './Components/TutorialCard.vue';

const page = usePage();
const selectedCategory = ref('all');
const searchQuery = ref('');

// Check if there's a search query in the URL
onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    if (searchParam) {
        searchQuery.value = searchParam;
    }
});

const tutorials = [
    { id: 1, title: 'Getting Started with Azure Virtual Machines', category: 'compute', level: 'Beginner', duration: '30 min', students: 1250, rating: 4.8 },
    { id: 2, title: 'Deploy Web Apps with Azure App Service', category: 'compute', level: 'Beginner', duration: '45 min', students: 980, rating: 4.7 },
    { id: 3, title: 'Serverless Computing with Azure Functions', category: 'compute', level: 'Intermediate', duration: '60 min', students: 1450, rating: 4.9 },
    { id: 4, title: 'Container Management with ACI', category: 'compute', level: 'Intermediate', duration: '50 min', students: 720, rating: 4.6 },
    { id: 5, title: 'Kubernetes on Azure (AKS)', category: 'compute', level: 'Advanced', duration: '90 min', students: 2100, rating: 4.9 },
    { id: 6, title: 'Azure Batch for Large-Scale Computing', category: 'compute', level: 'Advanced', duration: '75 min', students: 450, rating: 4.5 },
    { id: 7, title: 'Azure Blob Storage Fundamentals', category: 'storage', level: 'Beginner', duration: '40 min', students: 1800, rating: 4.8 },
    { id: 8, title: 'File Storage and Sharing in Azure', category: 'storage', level: 'Beginner', duration: '35 min', students: 890, rating: 4.6 },
    { id: 9, title: 'Queue Storage for Message Processing', category: 'storage', level: 'Intermediate', duration: '45 min', students: 650, rating: 4.7 },
    { id: 10, title: 'NoSQL with Azure Table Storage', category: 'storage', level: 'Intermediate', duration: '50 min', students: 720, rating: 4.5 },
    { id: 11, title: 'Managed Disks for Virtual Machines', category: 'storage', level: 'Intermediate', duration: '40 min', students: 580, rating: 4.6 },
    { id: 12, title: 'Azure Data Lake Storage Gen2', category: 'storage', level: 'Advanced', duration: '80 min', students: 920, rating: 4.8 },
    { id: 19, title: 'Azure SQL Database Essentials', category: 'database', level: 'Beginner', duration: '55 min', students: 2200, rating: 4.9 },
    { id: 20, title: 'Cosmos DB for Global Applications', category: 'database', level: 'Intermediate', duration: '70 min', students: 1680, rating: 4.8 },
    { id: 21, title: 'MySQL on Azure', category: 'database', level: 'Beginner', duration: '45 min', students: 1100, rating: 4.7 },
    { id: 22, title: 'PostgreSQL Database Service', category: 'database', level: 'Beginner', duration: '50 min', students: 980, rating: 4.6 },
    { id: 25, title: 'Azure Cognitive Services Overview', category: 'ai', level: 'Beginner', duration: '50 min', students: 1750, rating: 4.8 },
    { id: 26, title: 'Machine Learning Studio Tutorial', category: 'ai', level: 'Intermediate', duration: '90 min', students: 2400, rating: 4.9 },
    { id: 28, title: 'Azure OpenAI Integration', category: 'ai', level: 'Intermediate', duration: '75 min', students: 3200, rating: 4.9 },
    { id: 31, title: 'Azure Key Vault Fundamentals', category: 'security', level: 'Beginner', duration: '40 min', students: 1600, rating: 4.8 },
    { id: 33, title: 'Azure Active Directory Setup', category: 'security', level: 'Beginner', duration: '60 min', students: 2100, rating: 4.9 },
    { id: 37, title: 'Azure DevOps Getting Started', category: 'devops', level: 'Beginner', duration: '55 min', students: 2800, rating: 4.9 },
    { id: 38, title: 'CI/CD with Azure Pipelines', category: 'devops', level: 'Intermediate', duration: '85 min', students: 2200, rating: 4.8 },
];

const categories = [
    { id: 'all', name: 'All Tutorials', count: tutorials.length },
    { id: 'compute', name: 'Compute', count: tutorials.filter(t => t.category === 'compute').length },
    { id: 'storage', name: 'Storage', count: tutorials.filter(t => t.category === 'storage').length },
    { id: 'database', name: 'Databases', count: tutorials.filter(t => t.category === 'database').length },
    { id: 'ai', name: 'AI + ML', count: tutorials.filter(t => t.category === 'ai').length },
    { id: 'security', name: 'Security', count: tutorials.filter(t => t.category === 'security').length },
    { id: 'devops', name: 'DevOps', count: tutorials.filter(t => t.category === 'devops').length },
];

const filteredTutorials = computed(() => {
    let filtered = tutorials;
    
    // Filter by category
    if (selectedCategory.value !== 'all') {
        filtered = filtered.filter(t => t.category === selectedCategory.value);
    }
    
    // Filter by search query
    if (searchQuery.value && searchQuery.value.trim() !== '') {
        const query = searchQuery.value.toLowerCase().trim();
        filtered = filtered.filter(t => 
            t.title.toLowerCase().includes(query) ||
            t.level.toLowerCase().includes(query)
        );
    }
    
    return filtered;
});
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-primary-50/30">
        <Head>
            <title>Azure Tutorials - Learn Azure Services | AzureSkill</title>
            <meta name="description" content="Browse 200+ comprehensive Azure tutorials covering Compute, Storage, Databases, AI/ML, Security, and DevOps. Step-by-step guides from beginner to advanced level." />
            <meta name="keywords" content="Azure tutorials, Azure compute, Azure storage, Azure database, Azure AI, Azure security, Azure DevOps, cloud tutorials" />
        </Head>
        
        <Header />
        
        <!-- Hero Section -->
        <div class="relative pt-24 pb-12 bg-white overflow-hidden">
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

            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-primary-50 to-primary-100 border border-primary-200 mb-6">
                    <svg class="w-4 h-4 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <span class="text-sm font-semibold text-primary-700">{{ tutorials.length }} Tutorials Available</span>
                </div>

                <h1 class="text-4xl sm:text-5xl font-bold text-navy-900 mb-4">
                    Azure Tutorials
                </h1>
                <p class="text-lg text-navy-600 max-w-2xl mx-auto mb-8">
                    Master Azure services with our comprehensive step-by-step guides. From beginner to advanced level.
                </p>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto mb-8">
                    <div class="relative">
                        <input 
                            type="text" 
                            v-model="searchQuery"
                            placeholder="Search tutorials by name or difficulty..." 
                            class="w-full pl-12 pr-12 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-200 outline-none transition-all shadow-lg"
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

                <!-- Filter Tabs -->
                <div class="inline-flex bg-white/80 backdrop-blur-lg rounded-2xl p-2 shadow-xl border-2 border-primary-200 flex-wrap justify-center">
                    <button
                        v-for="category in categories"
                        :key="category.id"
                        @click="selectedCategory = category.id"
                        class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300 whitespace-nowrap"
                        :class="selectedCategory === category.id 
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg' 
                            : 'text-navy-600 hover:text-navy-900 hover:bg-primary-50'"
                    >
                        {{ category.name }} ({{ category.count }})
                    </button>
                </div>
            </div>
        </div>

        <!-- Tutorials Grid -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 translate-y-8"
                enter-to-class="opacity-100 translate-y-0"
                mode="out-in"
            >
                <div v-if="filteredTutorials.length > 0" :key="selectedCategory + searchQuery" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <TutorialCard
                        v-for="(tutorial, index) in filteredTutorials"
                        :key="tutorial.id"
                        :tutorial="tutorial"
                        :index="index"
                    />
                </div>
                <div v-else class="text-center py-16">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy-900 mb-2">No tutorials found</h3>
                    <p class="text-gray-600 mb-6">Try adjusting your search or browse a different category</p>
                    <button 
                        @click="searchQuery = ''; selectedCategory = 'all'"
                        class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-colors"
                    >
                        Clear Filters
                    </button>
                </div>
            </transition>
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
