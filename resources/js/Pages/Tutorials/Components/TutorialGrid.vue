<script setup>
import { computed } from 'vue';

const props = defineProps({
    category: {
        type: String,
        required: true
    },
    searchQuery: {
        type: String,
        default: ''
    }
});

const tutorials = {
    compute: [
        { id: 1, title: 'Getting Started with Azure Virtual Machines', level: 'Beginner', duration: '30 min', students: 1250, rating: 4.8, thumbnail: 'vm' },
        { id: 2, title: 'Deploy Web Apps with Azure App Service', level: 'Beginner', duration: '45 min', students: 980, rating: 4.7, thumbnail: 'app' },
        { id: 3, title: 'Serverless Computing with Azure Functions', level: 'Intermediate', duration: '60 min', students: 1450, rating: 4.9, thumbnail: 'functions' },
        { id: 4, title: 'Container Management with ACI', level: 'Intermediate', duration: '50 min', students: 720, rating: 4.6, thumbnail: 'container' },
        { id: 5, title: 'Kubernetes on Azure (AKS)', level: 'Advanced', duration: '90 min', students: 2100, rating: 4.9, thumbnail: 'aks' },
        { id: 6, title: 'Azure Batch for Large-Scale Computing', level: 'Advanced', duration: '75 min', students: 450, rating: 4.5, thumbnail: 'batch' },
    ],
    storage: [
        { id: 7, title: 'Azure Blob Storage Fundamentals', level: 'Beginner', duration: '40 min', students: 1800, rating: 4.8, thumbnail: 'blob' },
        { id: 8, title: 'File Storage and Sharing in Azure', level: 'Beginner', duration: '35 min', students: 890, rating: 4.6, thumbnail: 'file' },
        { id: 9, title: 'Queue Storage for Message Processing', level: 'Intermediate', duration: '45 min', students: 650, rating: 4.7, thumbnail: 'queue' },
        { id: 10, title: 'NoSQL with Azure Table Storage', level: 'Intermediate', duration: '50 min', students: 720, rating: 4.5, thumbnail: 'table' },
        { id: 11, title: 'Managed Disks for Virtual Machines', level: 'Intermediate', duration: '40 min', students: 580, rating: 4.6, thumbnail: 'disk' },
        { id: 12, title: 'Azure Data Lake Storage Gen2', level: 'Advanced', duration: '80 min', students: 920, rating: 4.8, thumbnail: 'datalake' },
    ],
    networking: [
        { id: 13, title: 'Azure Virtual Network Basics', level: 'Beginner', duration: '45 min', students: 1500, rating: 4.7, thumbnail: 'vnet' },
        { id: 14, title: 'Load Balancing in Azure', level: 'Intermediate', duration: '55 min', students: 880, rating: 4.6, thumbnail: 'lb' },
        { id: 15, title: 'Application Gateway Deep Dive', level: 'Intermediate', duration: '70 min', students: 750, rating: 4.8, thumbnail: 'appgw' },
        { id: 16, title: 'VPN Gateway Configuration', level: 'Advanced', duration: '65 min', students: 620, rating: 4.7, thumbnail: 'vpn' },
        { id: 17, title: 'Azure CDN Implementation', level: 'Intermediate', duration: '50 min', students: 940, rating: 4.6, thumbnail: 'cdn' },
        { id: 18, title: 'Traffic Manager for Global Apps', level: 'Advanced', duration: '60 min', students: 510, rating: 4.5, thumbnail: 'tm' },
    ],
    database: [
        { id: 19, title: 'Azure SQL Database Essentials', level: 'Beginner', duration: '55 min', students: 2200, rating: 4.9, thumbnail: 'sql' },
        { id: 20, title: 'Cosmos DB for Global Applications', level: 'Intermediate', duration: '70 min', students: 1680, rating: 4.8, thumbnail: 'cosmos' },
        { id: 21, title: 'MySQL on Azure', level: 'Beginner', duration: '45 min', students: 1100, rating: 4.7, thumbnail: 'mysql' },
        { id: 22, title: 'PostgreSQL Database Service', level: 'Beginner', duration: '50 min', students: 980, rating: 4.6, thumbnail: 'postgres' },
        { id: 23, title: 'SQL Managed Instance Migration', level: 'Advanced', duration: '85 min', students: 670, rating: 4.8, thumbnail: 'sqlmi' },
        { id: 24, title: 'Redis Cache for Performance', level: 'Intermediate', duration: '40 min', students: 820, rating: 4.7, thumbnail: 'redis' },
    ],
    ai: [
        { id: 25, title: 'Azure Cognitive Services Overview', level: 'Beginner', duration: '50 min', students: 1750, rating: 4.8, thumbnail: 'cognitive' },
        { id: 26, title: 'Machine Learning Studio Tutorial', level: 'Intermediate', duration: '90 min', students: 2400, rating: 4.9, thumbnail: 'ml' },
        { id: 27, title: 'Building Chatbots with Bot Service', level: 'Intermediate', duration: '65 min', students: 1100, rating: 4.7, thumbnail: 'bot' },
        { id: 28, title: 'Azure OpenAI Integration', level: 'Intermediate', duration: '75 min', students: 3200, rating: 4.9, thumbnail: 'openai' },
        { id: 29, title: 'Computer Vision API Implementation', level: 'Advanced', duration: '80 min', students: 1350, rating: 4.8, thumbnail: 'vision' },
        { id: 30, title: 'Form Recognizer for Documents', level: 'Intermediate', duration: '55 min', students: 780, rating: 4.6, thumbnail: 'form' },
    ],
    security: [
        { id: 31, title: 'Azure Key Vault Fundamentals', level: 'Beginner', duration: '40 min', students: 1600, rating: 4.8, thumbnail: 'keyvault' },
        { id: 32, title: 'Security Center Best Practices', level: 'Intermediate', duration: '70 min', students: 1250, rating: 4.7, thumbnail: 'security' },
        { id: 33, title: 'Azure Active Directory Setup', level: 'Beginner', duration: '60 min', students: 2100, rating: 4.9, thumbnail: 'ad' },
        { id: 34, title: 'Azure Sentinel SIEM', level: 'Advanced', duration: '95 min', students: 890, rating: 4.8, thumbnail: 'sentinel' },
        { id: 35, title: 'DDoS Protection Configuration', level: 'Intermediate', duration: '45 min', students: 650, rating: 4.6, thumbnail: 'ddos' },
        { id: 36, title: 'Azure Firewall Implementation', level: 'Advanced', duration: '75 min', students: 820, rating: 4.7, thumbnail: 'firewall' },
    ],
    devops: [
        { id: 37, title: 'Azure DevOps Getting Started', level: 'Beginner', duration: '55 min', students: 2800, rating: 4.9, thumbnail: 'devops' },
        { id: 38, title: 'CI/CD with Azure Pipelines', level: 'Intermediate', duration: '85 min', students: 2200, rating: 4.8, thumbnail: 'pipelines' },
        { id: 39, title: 'Git Repos in Azure', level: 'Beginner', duration: '35 min', students: 1400, rating: 4.7, thumbnail: 'repos' },
        { id: 40, title: 'Agile Project Management with Boards', level: 'Beginner', duration: '45 min', students: 1100, rating: 4.6, thumbnail: 'boards' },
        { id: 41, title: 'Package Management with Artifacts', level: 'Intermediate', duration: '50 min', students: 720, rating: 4.7, thumbnail: 'artifacts' },
        { id: 42, title: 'Testing with Azure Test Plans', level: 'Intermediate', duration: '60 min', students: 680, rating: 4.6, thumbnail: 'testplans' },
    ],
    web: [
        { id: 43, title: 'Azure Static Web Apps', level: 'Beginner', duration: '50 min', students: 1850, rating: 4.8, thumbnail: 'staticweb' },
        { id: 44, title: 'API Management Essentials', level: 'Intermediate', duration: '70 min', students: 1400, rating: 4.7, thumbnail: 'apim' },
        { id: 45, title: 'Push Notifications with Notification Hubs', level: 'Intermediate', duration: '55 min', students: 780, rating: 4.6, thumbnail: 'notifications' },
        { id: 46, title: 'Real-time Apps with SignalR', level: 'Advanced', duration: '75 min', students: 920, rating: 4.8, thumbnail: 'signalr' },
        { id: 47, title: 'Azure Maps Integration', level: 'Intermediate', duration: '60 min', students: 650, rating: 4.5, thumbnail: 'maps' },
        { id: 48, title: 'Cognitive Search Implementation', level: 'Advanced', duration: '80 min', students: 1100, rating: 4.9, thumbnail: 'search' },
    ],
};

const currentTutorials = computed(() => {
    let tutorialList = tutorials[props.category] || [];
    
    // Filter by search query
    if (props.searchQuery && props.searchQuery.trim() !== '') {
        const query = props.searchQuery.toLowerCase().trim();
        tutorialList = tutorialList.filter(tutorial => 
            tutorial.title.toLowerCase().includes(query) ||
            tutorial.level.toLowerCase().includes(query)
        );
    }
    
    return tutorialList;
});

const getLevelColor = (level) => {
    const colors = {
        'Beginner': 'bg-green-100 text-green-700 border-green-200',
        'Intermediate': 'bg-yellow-100 text-yellow-700 border-yellow-200',
        'Advanced': 'bg-red-100 text-red-700 border-red-200'
    };
    return colors[level] || 'bg-gray-100 text-gray-700';
};
</script>

<template>
    <div class="flex-1">
        <!-- Results Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-navy-900">
                    {{ currentTutorials.length }} Tutorial{{ currentTutorials.length !== 1 ? 's' : '' }}
                    <span v-if="searchQuery" class="text-primary-600">matching "{{ searchQuery }}"</span>
                </h2>
                <p class="text-gray-600">
                    <span v-if="searchQuery">Showing results in {{ category }} category</span>
                    <span v-else>Select a tutorial to start learning</span>
                </p>
            </div>
            <select class="px-4 py-2 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                <option>Most Popular</option>
                <option>Newest First</option>
                <option>Highest Rated</option>
                <option>Shortest Duration</option>
            </select>
        </div>

        <!-- No Results Message -->
        <div v-if="currentTutorials.length === 0" class="text-center py-16">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-navy-900 mb-2">No tutorials found</h3>
            <p class="text-gray-600 mb-6">Try adjusting your search or browse a different category</p>
            <button 
                @click="$emit('clear-search')"
                class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-colors"
            >
                Clear Search
            </button>
        </div>

        <!-- Tutorial Cards Grid -->
        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div
                v-for="tutorial in currentTutorials"
                :key="tutorial.id"
                class="group bg-white rounded-2xl border-2 border-gray-200 hover:border-primary-300 p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 cursor-pointer"
            >
                <!-- Tutorial Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-navy-900 group-hover:text-primary-600 transition-colors mb-2 line-clamp-2">
                            {{ tutorial.title }}
                        </h3>
                        <div class="flex items-center space-x-3">
                            <span 
                                class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold border"
                                :class="getLevelColor(tutorial.level)"
                            >
                                {{ tutorial.level }}
                            </span>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ tutorial.duration }}
                            </div>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>

                <!-- Tutorial Stats -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <span class="font-semibold">{{ tutorial.rating }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            {{ tutorial.students.toLocaleString() }}
                        </div>
                    </div>
                    <button class="px-4 py-2 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-lg transition-all duration-300 group-hover:scale-105 text-sm">
                        Start Tutorial
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
