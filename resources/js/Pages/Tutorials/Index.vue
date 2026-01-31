<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const selectedCategory = ref('all');
const searchQuery = ref('');
const isSidebarOpen = ref(false);
const isHeroVisible = ref(false);

onMounted(() => {
    setTimeout(() => isHeroVisible.value = true, 100);

    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    if (searchParam) searchQuery.value = searchParam;
});

// Azure Services organized by category with official icon colors
const services = {
    compute: {
        name: 'Compute',
        icon: 'compute',
        color: '#0078D4',
        items: [
            { name: 'Virtual Machines', icon: 'vm', tutorials: 12 },
            { name: 'App Service', icon: 'app-service', tutorials: 8 },
            { name: 'Functions', icon: 'functions', tutorials: 6 },
            { name: 'Container Instances', icon: 'container', tutorials: 5 },
            { name: 'Kubernetes Service', icon: 'aks', tutorials: 10 },
            { name: 'Batch', icon: 'batch', tutorials: 3 },
            { name: 'Cloud Services', icon: 'cloud-services', tutorials: 4 },
            { name: 'VM Scale Sets', icon: 'vmss', tutorials: 5 },
        ]
    },
    storage: {
        name: 'Storage',
        icon: 'storage',
        color: '#0078D4',
        items: [
            { name: 'Storage Accounts', icon: 'storage-account', tutorials: 8 },
            { name: 'Blob Storage', icon: 'blob', tutorials: 10 },
            { name: 'File Storage', icon: 'file-storage', tutorials: 5 },
            { name: 'Queue Storage', icon: 'queue', tutorials: 4 },
            { name: 'Table Storage', icon: 'table', tutorials: 3 },
            { name: 'Data Lake', icon: 'data-lake', tutorials: 6 },
            { name: 'Managed Disks', icon: 'disk', tutorials: 5 },
        ]
    },
    networking: {
        name: 'Networking',
        icon: 'networking',
        color: '#0078D4',
        items: [
            { name: 'Virtual Network', icon: 'vnet', tutorials: 8 },
            { name: 'Load Balancer', icon: 'load-balancer', tutorials: 6 },
            { name: 'Application Gateway', icon: 'app-gateway', tutorials: 5 },
            { name: 'VPN Gateway', icon: 'vpn', tutorials: 4 },
            { name: 'Azure DNS', icon: 'dns', tutorials: 3 },
            { name: 'CDN', icon: 'cdn', tutorials: 4 },
            { name: 'Front Door', icon: 'front-door', tutorials: 5 },
            { name: 'ExpressRoute', icon: 'expressroute', tutorials: 3 },
        ]
    },
    database: {
        name: 'Databases',
        icon: 'database',
        color: '#0078D4',
        items: [
            { name: 'SQL Database', icon: 'sql', tutorials: 12 },
            { name: 'Cosmos DB', icon: 'cosmos', tutorials: 10 },
            { name: 'MySQL', icon: 'mysql', tutorials: 6 },
            { name: 'PostgreSQL', icon: 'postgresql', tutorials: 5 },
            { name: 'SQL Managed Instance', icon: 'sql-mi', tutorials: 4 },
            { name: 'Redis Cache', icon: 'redis', tutorials: 5 },
            { name: 'MariaDB', icon: 'mariadb', tutorials: 3 },
        ]
    },
    ai: {
        name: 'AI + ML',
        icon: 'ai',
        color: '#0078D4',
        items: [
            { name: 'Machine Learning', icon: 'ml', tutorials: 15 },
            { name: 'Cognitive Services', icon: 'cognitive', tutorials: 12 },
            { name: 'Azure OpenAI', icon: 'openai', tutorials: 8 },
            { name: 'Bot Service', icon: 'bot', tutorials: 5 },
            { name: 'Computer Vision', icon: 'vision', tutorials: 6 },
            { name: 'Speech Services', icon: 'speech', tutorials: 4 },
            { name: 'Language Service', icon: 'language', tutorials: 5 },
            { name: 'Document Intelligence', icon: 'document', tutorials: 4 },
        ]
    },
    security: {
        name: 'Security',
        icon: 'security',
        color: '#0078D4',
        items: [
            { name: 'Microsoft Entra ID', icon: 'entra', tutorials: 10 },
            { name: 'Key Vault', icon: 'keyvault', tutorials: 8 },
            { name: 'Security Center', icon: 'security-center', tutorials: 6 },
            { name: 'Sentinel', icon: 'sentinel', tutorials: 5 },
            { name: 'DDoS Protection', icon: 'ddos', tutorials: 3 },
            { name: 'Firewall', icon: 'firewall', tutorials: 5 },
        ]
    },
    devops: {
        name: 'DevOps',
        icon: 'devops',
        color: '#0078D4',
        items: [
            { name: 'Azure DevOps', icon: 'azure-devops', tutorials: 12 },
            { name: 'GitHub Actions', icon: 'github', tutorials: 8 },
            { name: 'Container Registry', icon: 'acr', tutorials: 6 },
            { name: 'Pipelines', icon: 'pipelines', tutorials: 10 },
            { name: 'Repos', icon: 'repos', tutorials: 5 },
            { name: 'Artifacts', icon: 'artifacts', tutorials: 4 },
        ]
    },
    analytics: {
        name: 'Analytics',
        icon: 'analytics',
        color: '#0078D4',
        items: [
            { name: 'Synapse Analytics', icon: 'synapse', tutorials: 10 },
            { name: 'Data Factory', icon: 'data-factory', tutorials: 8 },
            { name: 'Databricks', icon: 'databricks', tutorials: 7 },
            { name: 'Stream Analytics', icon: 'stream', tutorials: 5 },
            { name: 'HDInsight', icon: 'hdinsight', tutorials: 4 },
            { name: 'Power BI Embedded', icon: 'powerbi', tutorials: 6 },
        ]
    },
    integration: {
        name: 'Integration',
        icon: 'integration',
        color: '#0078D4',
        items: [
            { name: 'Logic Apps', icon: 'logic-apps', tutorials: 8 },
            { name: 'Service Bus', icon: 'service-bus', tutorials: 6 },
            { name: 'Event Grid', icon: 'event-grid', tutorials: 5 },
            { name: 'Event Hubs', icon: 'event-hubs', tutorials: 5 },
            { name: 'API Management', icon: 'apim', tutorials: 7 },
        ]
    },
    monitor: {
        name: 'Monitor',
        icon: 'monitor',
        color: '#0078D4',
        items: [
            { name: 'Azure Monitor', icon: 'monitor-icon', tutorials: 8 },
            { name: 'Log Analytics', icon: 'log-analytics', tutorials: 6 },
            { name: 'Application Insights', icon: 'app-insights', tutorials: 7 },
            { name: 'Alerts', icon: 'alerts', tutorials: 4 },
        ]
    }
};

const categories = computed(() => {
    const cats = [
        { id: 'all', name: 'All Services', icon: 'grid', count: Object.values(services).reduce((sum, cat) => sum + cat.items.length, 0) },
        { id: 'favorites', name: 'Favorites', icon: 'star', count: 0 },
    ];

    Object.entries(services).forEach(([id, cat]) => {
        cats.push({ id, name: cat.name, icon: cat.icon, count: cat.items.length });
    });

    return cats;
});

const filteredServices = computed(() => {
    const query = searchQuery.value.toLowerCase().trim();

    if (selectedCategory.value === 'all') {
        if (!query) return services;

        const filtered = {};
        Object.entries(services).forEach(([key, cat]) => {
            const items = cat.items.filter(item => item.name.toLowerCase().includes(query));
            if (items.length > 0) {
                filtered[key] = { ...cat, items };
            }
        });
        return filtered;
    }

    if (selectedCategory.value === 'favorites') {
        return {};
    }

    const cat = services[selectedCategory.value];
    if (!cat) return {};

    if (!query) {
        return { [selectedCategory.value]: cat };
    }

    const items = cat.items.filter(item => item.name.toLowerCase().includes(query));
    if (items.length === 0) return {};

    return { [selectedCategory.value]: { ...cat, items } };
});

const totalFilteredCount = computed(() => {
    return Object.values(filteredServices.value).reduce((sum, cat) => sum + cat.items.length, 0);
});
</script>

<template>
    <div class="min-h-screen bg-navy-50">
        <Head>
            <title>Azure Services - Browse All Tutorials | AzureSkill</title>
            <meta name="description" content="Browse all Azure service tutorials. Learn Compute, Storage, Networking, Databases, AI/ML, Security, DevOps, and more." />
        </Head>

        <Header />

        <!-- Ultra Modern Hero Section -->
        <section class="relative pt-32 pb-20 overflow-hidden bg-gradient-to-br from-navy-950 via-primary-900 to-navy-900">
            <!-- Animated Grid Background -->
            <div class="absolute inset-0">
                <svg class="absolute w-full h-full opacity-20" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="hero-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                        </pattern>
                        <linearGradient id="grid-fade" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:white;stop-opacity:0.3" />
                            <stop offset="100%" style="stop-color:white;stop-opacity:0" />
                        </linearGradient>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#hero-grid)" />
                </svg>
            </div>

            <!-- Animated Orbs -->
            <div class="absolute top-10 left-10 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

            <!-- Floating Icons -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-20 left-[15%] animate-float-slow">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20">
                        <svg class="w-6 h-6 text-blue-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-32 right-[20%] animate-float-delayed">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center border border-white/20">
                        <svg class="w-5 h-5 text-cyan-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute bottom-20 left-[25%] animate-float-slow" style="animation-delay: 2s;">
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20">
                        <svg class="w-7 h-7 text-purple-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M4 4h16v16H4V4z M8 8v8h8V8H8z"/>
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
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                        <span class="text-sm text-primary-100">{{ Object.values(services).reduce((sum, cat) => sum + cat.items.length, 0) }}+ Azure Services</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                        All
                        <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Azure</span>
                        Services
                    </h1>
                    <p class="text-lg text-primary-200/80 max-w-2xl mx-auto mb-8">
                        Browse and learn any Azure service with our comprehensive tutorials
                    </p>

                    <!-- Search Bar -->
                    <div class="max-w-2xl mx-auto">
                        <div class="relative">
                            <input
                                type="text"
                                v-model="searchQuery"
                                placeholder="Filter services..."
                                class="w-full pl-12 pr-12 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-primary-200/50 focus:border-white/40 focus:ring-2 focus:ring-white/20 outline-none transition-all"
                            />
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-primary-200/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <button
                                v-if="searchQuery"
                                @click="searchQuery = ''"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-primary-200/60 hover:text-white transition-colors"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content with Sidebar -->
        <div class="w-full px-4 sm:px-6 lg:px-12 xl:px-20 py-8">
            <div class="flex gap-8">
                <!-- Mobile Sidebar Toggle -->
                <button
                    @click="isSidebarOpen = !isSidebarOpen"
                    class="lg:hidden fixed bottom-6 right-6 z-50 w-14 h-14 bg-primary-600 text-white rounded-full shadow-xl flex items-center justify-center hover:bg-primary-700 transition-colors"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Sidebar -->
                <aside
                    class="fixed lg:sticky lg:top-24 inset-y-0 left-0 z-40 w-64 bg-white lg:bg-transparent transform transition-transform duration-300 lg:transform-none overflow-y-auto"
                    :class="isSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                >
                    <!-- Mobile Overlay -->
                    <div
                        v-if="isSidebarOpen"
                        @click="isSidebarOpen = false"
                        class="fixed inset-0 bg-black/50 lg:hidden -z-10"
                    ></div>

                    <div class="bg-white rounded-2xl shadow-sm border border-navy-100 p-4 lg:max-h-[calc(100vh-8rem)] overflow-y-auto">
                        <div class="flex items-center justify-between mb-4 lg:hidden">
                            <h3 class="font-bold text-navy-900">Categories</h3>
                            <button @click="isSidebarOpen = false" class="text-navy-400 hover:text-navy-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <nav class="space-y-1">
                            <button
                                v-for="category in categories"
                                :key="category.id"
                                @click="selectedCategory = category.id; isSidebarOpen = false"
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                                :class="selectedCategory === category.id
                                    ? 'bg-primary-50 text-primary-700 border-l-4 border-primary-600'
                                    : 'text-navy-600 hover:bg-navy-50 hover:text-navy-900'"
                            >
                                <span class="flex items-center">
                                    <!-- Category Icons -->
                                    <svg v-if="category.icon === 'grid'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4h4v4H4V4zm6 0h4v4h-4V4zm6 0h4v4h-4V4zM4 10h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 16h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'star'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'compute'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4h16v12H4V4zm0 14h16v2H4v-2zm2-12v8h12V6H6z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'storage'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4h16v4H4V4zm0 6h16v4H4v-4zm0 6h16v4H4v-4z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'networking'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'database'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <ellipse cx="12" cy="5" rx="9" ry="3"/>
                                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'ai'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2a2 2 0 012 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 017 7h1a1 1 0 110 2h-1v1a2 2 0 01-2 2h-1v1a1 1 0 11-2 0v-1h-2v1a1 1 0 11-2 0v-1H9a2 2 0 01-2-2v-1H6a1 1 0 110-2h1a7 7 0 017-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 012-2z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'security'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'devops'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'analytics'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 3v18h18V3H3zm16 16H5V5h14v14zM7 12h2v5H7v-5zm4-5h2v10h-2V7zm4 3h2v7h-2v-7z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'integration'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17 7h-4v2h4c1.65 0 3 1.35 3 3s-1.35 3-3 3h-4v2h4c2.76 0 5-2.24 5-5s-2.24-5-5-5zm-6 8H7c-1.65 0-3-1.35-3-3s1.35-3 3-3h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-2zm-3-4h8v2H8v-2z"/>
                                    </svg>
                                    <svg v-else-if="category.icon === 'monitor'" class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                    </svg>
                                    <svg v-else class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4h4v4H4V4zm6 0h4v4h-4V4zm6 0h4v4h-4V4z"/>
                                    </svg>
                                    {{ category.name }}
                                </span>
                                <span class="text-xs bg-navy-100 text-navy-600 px-2 py-0.5 rounded-full">
                                    {{ category.count }}
                                </span>
                            </button>
                        </nav>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="flex-1 min-w-0">
                    <!-- Header Bar -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-navy-900">
                                {{ categories.find(c => c.id === selectedCategory)?.name || 'All Services' }}
                            </h2>
                            <p class="text-sm text-navy-500">{{ totalFilteredCount }} services found</p>
                        </div>
                    </div>

                    <!-- Services Grid -->
                    <div v-if="totalFilteredCount > 0" class="space-y-8">
                        <div
                            v-for="(category, categoryKey) in filteredServices"
                            :key="categoryKey"
                            class="bg-white rounded-2xl shadow-sm border border-navy-100 overflow-hidden"
                        >
                            <!-- Category Header -->
                            <div class="px-6 py-4 bg-navy-50 border-b border-navy-100">
                                <h3 class="font-semibold text-navy-800">{{ category.name }}</h3>
                            </div>

                            <!-- Services Grid -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                                    <a
                                        v-for="service in category.items"
                                        :key="service.name"
                                        href="#"
                                        class="group flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary-50 transition-all duration-200 border border-transparent hover:border-primary-200"
                                    >
                                        <!-- Service Icon -->
                                        <div class="w-8 h-8 flex-shrink-0 flex items-center justify-center">
                                            <!-- COMPUTE ICONS -->
                                            <!-- Virtual Machines -->
                                            <svg v-if="service.icon === 'vm'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M17 8.5V4.33l-4-2.5-4 2.5v4.17l4 2.5 4-2.5z" fill="#0078D4"/>
                                                <path d="M9 10.5V6.33l-4-2.5-4 2.5v4.17l4 2.5 4-2.5z" fill="#50E6FF"/>
                                                <path d="M13 16.5v-4.17l-4-2.5-4 2.5v4.17l4 2.5 4-2.5z" fill="#0078D4"/>
                                            </svg>
                                            <!-- App Service -->
                                            <svg v-else-if="service.icon === 'app-service'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="1" y="3" width="16" height="12" rx="1" fill="#0078D4"/>
                                                <path d="M5 7h8M5 9h6M5 11h4" stroke="white" stroke-width="1.2"/>
                                            </svg>
                                            <!-- Functions -->
                                            <svg v-else-if="service.icon === 'functions'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 1L2 5v8l7 4 7-4V5L9 1z" fill="#FFCA00"/>
                                                <path d="M6 6l3 3-3 3M10 12h3" stroke="#5C2D91" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- Container Instances -->
                                            <svg v-else-if="service.icon === 'container'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="4" width="14" height="10" rx="1" fill="#0078D4"/>
                                                <path d="M5 7h3v4H5V7zM10 7h3v4h-3V7z" fill="#50E6FF"/>
                                            </svg>
                                            <!-- AKS / Kubernetes -->
                                            <svg v-else-if="service.icon === 'aks'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 1l8 4.5v7L9 17l-8-4.5v-7L9 1z" fill="#326CE5"/>
                                                <path d="M9 5l4 2.5v3L9 13l-4-2.5v-3L9 5z" fill="white"/>
                                            </svg>
                                            <!-- Batch -->
                                            <svg v-else-if="service.icon === 'batch'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="1" y="1" width="6" height="6" rx="1" fill="#0078D4"/>
                                                <rect x="9" y="1" width="6" height="6" rx="1" fill="#0078D4"/>
                                                <rect x="1" y="9" width="6" height="6" rx="1" fill="#0078D4"/>
                                                <rect x="9" y="9" width="6" height="6" rx="1" fill="#50E6FF"/>
                                            </svg>
                                            <!-- Cloud Services -->
                                            <svg v-else-if="service.icon === 'cloud-services'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M14.5 13h-11A3.5 3.5 0 010 9.5 3.5 3.5 0 013.5 6c.2-2.2 2.1-4 4.5-4 2.5 0 4.5 2 4.5 4.5v.5h2a3 3 0 010 6z" fill="#0078D4"/>
                                                <path d="M6 10l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- VM Scale Sets -->
                                            <svg v-else-if="service.icon === 'vmss'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="1" y="1" width="7" height="5" rx="1" fill="#0078D4"/>
                                                <rect x="10" y="1" width="7" height="5" rx="1" fill="#0078D4"/>
                                                <rect x="1" y="8" width="7" height="5" rx="1" fill="#50E6FF"/>
                                                <rect x="10" y="8" width="7" height="5" rx="1" fill="#50E6FF"/>
                                                <path d="M9 15v2M5 15v2M13 15v2" stroke="#0078D4" stroke-width="1.5"/>
                                            </svg>

                                            <!-- STORAGE ICONS -->
                                            <!-- Storage Account -->
                                            <svg v-else-if="service.icon === 'storage-account'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="14" height="4" rx="1" fill="#0078D4"/>
                                                <rect x="2" y="7" width="14" height="4" rx="1" fill="#0078D4"/>
                                                <rect x="2" y="12" width="14" height="4" rx="1" fill="#50E6FF"/>
                                            </svg>
                                            <!-- Blob Storage -->
                                            <svg v-else-if="service.icon === 'blob'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="3" width="14" height="12" rx="2" fill="#0078D4"/>
                                                <rect x="4" y="5" width="4" height="3" rx="0.5" fill="#50E6FF"/>
                                                <rect x="10" y="5" width="4" height="3" rx="0.5" fill="#50E6FF"/>
                                                <rect x="4" y="10" width="4" height="3" rx="0.5" fill="#50E6FF"/>
                                                <rect x="10" y="10" width="4" height="3" rx="0.5" fill="#50E6FF"/>
                                            </svg>
                                            <!-- File Storage -->
                                            <svg v-else-if="service.icon === 'file-storage'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M4 2h7l4 4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V3a1 1 0 011-1z" fill="#0078D4"/>
                                                <path d="M11 2v4h4" fill="#50E6FF"/>
                                                <path d="M6 10h6M6 13h4" stroke="white" stroke-width="1.2"/>
                                            </svg>
                                            <!-- Queue Storage -->
                                            <svg v-else-if="service.icon === 'queue'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="3" width="14" height="3" rx="1" fill="#0078D4"/>
                                                <rect x="2" y="7.5" width="14" height="3" rx="1" fill="#50E6FF"/>
                                                <rect x="2" y="12" width="14" height="3" rx="1" fill="#0078D4"/>
                                            </svg>
                                            <!-- Table Storage -->
                                            <svg v-else-if="service.icon === 'table'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="14" height="14" rx="1" fill="#0078D4"/>
                                                <path d="M2 6h14M6 6v10" stroke="#50E6FF" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Data Lake -->
                                            <svg v-else-if="service.icon === 'data-lake'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <ellipse cx="9" cy="14" rx="7" ry="2" fill="#50E6FF"/>
                                                <ellipse cx="9" cy="11" rx="7" ry="2" fill="#0078D4"/>
                                                <ellipse cx="9" cy="8" rx="7" ry="2" fill="#50E6FF"/>
                                                <ellipse cx="9" cy="5" rx="7" ry="2" fill="#0078D4"/>
                                            </svg>
                                            <!-- Managed Disks -->
                                            <svg v-else-if="service.icon === 'disk'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <circle cx="9" cy="9" r="4" fill="#50E6FF"/>
                                                <circle cx="9" cy="9" r="1.5" fill="#0078D4"/>
                                            </svg>

                                            <!-- NETWORKING ICONS -->
                                            <!-- Virtual Network -->
                                            <svg v-else-if="service.icon === 'vnet'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="5" height="5" rx="1" fill="#0078D4"/>
                                                <rect x="11" y="2" width="5" height="5" rx="1" fill="#0078D4"/>
                                                <rect x="2" y="11" width="5" height="5" rx="1" fill="#0078D4"/>
                                                <rect x="11" y="11" width="5" height="5" rx="1" fill="#0078D4"/>
                                                <path d="M7 4.5h4M7 13.5h4M4.5 7v4M13.5 7v4" stroke="#50E6FF" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Load Balancer -->
                                            <svg v-else-if="service.icon === 'load-balancer'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="4" r="3" fill="#0078D4"/>
                                                <circle cx="4" cy="14" r="2" fill="#50E6FF"/>
                                                <circle cx="9" cy="14" r="2" fill="#50E6FF"/>
                                                <circle cx="14" cy="14" r="2" fill="#50E6FF"/>
                                                <path d="M9 7v3M5 11l-1 1M13 11l1 1" stroke="#0078D4" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Application Gateway -->
                                            <svg v-else-if="service.icon === 'app-gateway'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="6" width="14" height="6" rx="1" fill="#0078D4"/>
                                                <circle cx="5" cy="9" r="1.5" fill="#50E6FF"/>
                                                <circle cx="9" cy="9" r="1.5" fill="#50E6FF"/>
                                                <circle cx="13" cy="9" r="1.5" fill="#50E6FF"/>
                                                <path d="M9 2v4M9 12v4" stroke="#0078D4" stroke-width="1.5"/>
                                            </svg>
                                            <!-- VPN Gateway -->
                                            <svg v-else-if="service.icon === 'vpn'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="4" width="6" height="10" rx="1" fill="#0078D4"/>
                                                <rect x="10" y="4" width="6" height="10" rx="1" fill="#0078D4"/>
                                                <path d="M8 9h2" stroke="#50E6FF" stroke-width="2"/>
                                                <circle cx="5" cy="9" r="1.5" fill="#50E6FF"/>
                                                <circle cx="13" cy="9" r="1.5" fill="#50E6FF"/>
                                            </svg>
                                            <!-- Azure DNS -->
                                            <svg v-else-if="service.icon === 'dns'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <text x="9" y="12" text-anchor="middle" fill="white" font-size="7" font-weight="bold">DNS</text>
                                            </svg>
                                            <!-- CDN -->
                                            <svg v-else-if="service.icon === 'cdn'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <path d="M3 9h12M9 3c-2 2-2 10 0 12M9 3c2 2 2 10 0 12" stroke="#50E6FF" stroke-width="1.2" fill="none"/>
                                            </svg>
                                            <!-- Front Door -->
                                            <svg v-else-if="service.icon === 'front-door'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="3" y="2" width="12" height="14" rx="1" fill="#0078D4"/>
                                                <rect x="5" y="4" width="8" height="10" rx="0.5" fill="#50E6FF"/>
                                                <circle cx="11" cy="9" r="1" fill="#0078D4"/>
                                            </svg>
                                            <!-- ExpressRoute -->
                                            <svg v-else-if="service.icon === 'expressroute'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M2 9h4l2-4 2 8 2-4h4" stroke="#0078D4" stroke-width="2" fill="none" stroke-linecap="round"/>
                                                <circle cx="2" cy="9" r="1.5" fill="#50E6FF"/>
                                                <circle cx="16" cy="9" r="1.5" fill="#50E6FF"/>
                                            </svg>

                                            <!-- DATABASE ICONS -->
                                            <!-- SQL Database -->
                                            <svg v-else-if="service.icon === 'sql'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#50E6FF"/>
                                                <path d="M3 4v10c0 1.4 2.7 2.5 6 2.5s6-1.1 6-2.5V4" fill="#0078D4"/>
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#50E6FF"/>
                                            </svg>
                                            <!-- Cosmos DB -->
                                            <svg v-else-if="service.icon === 'cosmos'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <ellipse cx="9" cy="9" rx="5.5" ry="2" stroke="#50E6FF" stroke-width="1.2" fill="none"/>
                                                <ellipse cx="9" cy="9" rx="5.5" ry="2" stroke="#50E6FF" stroke-width="1.2" fill="none" transform="rotate(60 9 9)"/>
                                                <ellipse cx="9" cy="9" rx="5.5" ry="2" stroke="#50E6FF" stroke-width="1.2" fill="none" transform="rotate(120 9 9)"/>
                                            </svg>
                                            <!-- MySQL -->
                                            <svg v-else-if="service.icon === 'mysql'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#F29111"/>
                                                <path d="M3 4v10c0 1.4 2.7 2.5 6 2.5s6-1.1 6-2.5V4" fill="#00758F"/>
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#F29111"/>
                                            </svg>
                                            <!-- PostgreSQL -->
                                            <svg v-else-if="service.icon === 'postgresql'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#50E6FF"/>
                                                <path d="M3 4v10c0 1.4 2.7 2.5 6 2.5s6-1.1 6-2.5V4" fill="#336791"/>
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#50E6FF"/>
                                            </svg>
                                            <!-- SQL Managed Instance -->
                                            <svg v-else-if="service.icon === 'sql-mi'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#50E6FF"/>
                                                <path d="M3 4v10c0 1.4 2.7 2.5 6 2.5s6-1.1 6-2.5V4" fill="#0078D4"/>
                                                <path d="M6 9h6M6 12h6" stroke="#50E6FF" stroke-width="1.2"/>
                                            </svg>
                                            <!-- Redis Cache -->
                                            <svg v-else-if="service.icon === 'redis'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 2L2 6v6l7 4 7-4V6L9 2z" fill="#D82C20"/>
                                                <path d="M9 6l4 2v3l-4 2-4-2V8l4-2z" fill="#white"/>
                                            </svg>
                                            <!-- MariaDB -->
                                            <svg v-else-if="service.icon === 'mariadb'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#50E6FF"/>
                                                <path d="M3 4v10c0 1.4 2.7 2.5 6 2.5s6-1.1 6-2.5V4" fill="#C97B2A"/>
                                                <ellipse cx="9" cy="4" rx="6" ry="2.5" fill="#50E6FF"/>
                                            </svg>

                                            <!-- AI + ML ICONS -->
                                            <!-- Machine Learning -->
                                            <svg v-else-if="service.icon === 'ml'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="14" height="14" rx="2" fill="#0078D4"/>
                                                <circle cx="6" cy="6" r="1.5" fill="#50E6FF"/>
                                                <circle cx="12" cy="6" r="1.5" fill="#50E6FF"/>
                                                <circle cx="9" cy="12" r="1.5" fill="#50E6FF"/>
                                                <path d="M6 6l3 6M12 6l-3 6M6 6h6" stroke="#50E6FF" stroke-width="1"/>
                                            </svg>
                                            <!-- Cognitive Services -->
                                            <svg v-else-if="service.icon === 'cognitive'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <path d="M9 5c-2.2 0-4 1.8-4 4 0 1.5.8 2.8 2 3.5V14h4v-1.5c1.2-.7 2-2 2-3.5 0-2.2-1.8-4-4-4z" fill="#50E6FF"/>
                                            </svg>
                                            <!-- Azure OpenAI -->
                                            <svg v-else-if="service.icon === 'openai'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#10A37F"/>
                                                <path d="M9 5v3M9 10v3M6 9h6" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- Bot Service -->
                                            <svg v-else-if="service.icon === 'bot'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="3" y="5" width="12" height="10" rx="2" fill="#0078D4"/>
                                                <circle cx="6.5" cy="9" r="1.5" fill="#50E6FF"/>
                                                <circle cx="11.5" cy="9" r="1.5" fill="#50E6FF"/>
                                                <path d="M6 12h6" stroke="#50E6FF" stroke-width="1.5" stroke-linecap="round"/>
                                                <path d="M9 5V3M7 3h4" stroke="#0078D4" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Computer Vision -->
                                            <svg v-else-if="service.icon === 'vision'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <circle cx="9" cy="9" r="4" fill="#50E6FF"/>
                                                <circle cx="9" cy="9" r="2" fill="#0078D4"/>
                                            </svg>
                                            <!-- Speech Services -->
                                            <svg v-else-if="service.icon === 'speech'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="6" y="2" width="6" height="10" rx="3" fill="#0078D4"/>
                                                <path d="M4 8v1a5 5 0 0010 0V8" stroke="#0078D4" stroke-width="1.5" fill="none"/>
                                                <path d="M9 14v2M7 16h4" stroke="#50E6FF" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Language Service -->
                                            <svg v-else-if="service.icon === 'language'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <text x="9" y="12" text-anchor="middle" fill="white" font-size="8" font-weight="bold">A</text>
                                            </svg>
                                            <!-- Document Intelligence -->
                                            <svg v-else-if="service.icon === 'document'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M4 2h7l4 4v10a1 1 0 01-1 1H4a1 1 0 01-1-1V3a1 1 0 011-1z" fill="#0078D4"/>
                                                <path d="M11 2v4h4" fill="#50E6FF"/>
                                                <circle cx="9" cy="11" r="3" fill="#50E6FF"/>
                                            </svg>

                                            <!-- SECURITY ICONS -->
                                            <!-- Microsoft Entra ID -->
                                            <svg v-else-if="service.icon === 'entra'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 1l7 4v6l-7 4-7-4V5l7-4z" fill="#0078D4"/>
                                                <circle cx="9" cy="7" r="2" fill="white"/>
                                                <path d="M6 13c0-2 1.3-3 3-3s3 1 3 3" stroke="white" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Key Vault -->
                                            <svg v-else-if="service.icon === 'keyvault'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="4" y="7" width="10" height="8" rx="1" fill="#0078D4"/>
                                                <circle cx="9" cy="5" r="3" stroke="#0078D4" stroke-width="2" fill="none"/>
                                                <circle cx="9" cy="11" r="1.5" fill="#FFB900"/>
                                            </svg>
                                            <!-- Security Center -->
                                            <svg v-else-if="service.icon === 'security-center'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 1L2 4v5c0 5 3 8 7 9 4-1 7-4 7-9V4L9 1z" fill="#0078D4"/>
                                                <path d="M6 9l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- Sentinel -->
                                            <svg v-else-if="service.icon === 'sentinel'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <path d="M9 4v5l3 3" stroke="#50E6FF" stroke-width="1.5" stroke-linecap="round"/>
                                                <circle cx="9" cy="9" r="1" fill="#50E6FF"/>
                                            </svg>
                                            <!-- DDoS Protection -->
                                            <svg v-else-if="service.icon === 'ddos'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 1L2 4v5c0 5 3 8 7 9 4-1 7-4 7-9V4L9 1z" fill="#0078D4"/>
                                                <path d="M6 9h6M9 6v6" stroke="#50E6FF" stroke-width="2"/>
                                            </svg>
                                            <!-- Firewall -->
                                            <svg v-else-if="service.icon === 'firewall'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="3" width="14" height="12" rx="1" fill="#0078D4"/>
                                                <path d="M2 7h14M6 7v8M12 7v8" stroke="#50E6FF" stroke-width="1.2"/>
                                            </svg>

                                            <!-- DEVOPS ICONS -->
                                            <!-- Azure DevOps -->
                                            <svg v-else-if="service.icon === 'azure-devops'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M16 4v10l-4 2.5V4.5L16 4zM2 6l4-2.5v12L2 14V6z" fill="#0078D4"/>
                                                <path d="M6 3.5L12 2v14l-6-1.5V3.5z" fill="#50E6FF"/>
                                            </svg>
                                            <!-- GitHub Actions -->
                                            <svg v-else-if="service.icon === 'github'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#24292E"/>
                                                <path d="M7 13c-2 .5-2-1-3-1M11 14v-2c0-.5-.2-1-.5-1.4 1.5-.2 3-.6 3-3 0-.6-.2-1.2-.6-1.6.2-.5.2-1 0-1.5 0 0-.5-.2-1.5.5a5 5 0 00-2.8 0c-1-.7-1.5-.5-1.5-.5-.2.5-.2 1 0 1.5-.4.4-.6 1-.6 1.6 0 2.4 1.5 2.8 3 3-.3.3-.5.8-.5 1.4v2" stroke="white" stroke-width="1.2" fill="none"/>
                                            </svg>
                                            <!-- Container Registry -->
                                            <svg v-else-if="service.icon === 'acr'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="14" height="14" rx="2" fill="#0078D4"/>
                                                <rect x="4" y="4" width="4" height="4" rx="0.5" fill="#50E6FF"/>
                                                <rect x="10" y="4" width="4" height="4" rx="0.5" fill="#50E6FF"/>
                                                <rect x="4" y="10" width="4" height="4" rx="0.5" fill="#50E6FF"/>
                                                <rect x="10" y="10" width="4" height="4" rx="0.5" fill="#50E6FF"/>
                                            </svg>
                                            <!-- Pipelines -->
                                            <svg v-else-if="service.icon === 'pipelines'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="4" cy="9" r="2" fill="#0078D4"/>
                                                <circle cx="9" cy="4" r="2" fill="#50E6FF"/>
                                                <circle cx="9" cy="14" r="2" fill="#50E6FF"/>
                                                <circle cx="14" cy="9" r="2" fill="#0078D4"/>
                                                <path d="M6 9h2M11 9h2M9 6v2M9 11v2" stroke="#0078D4" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Repos -->
                                            <svg v-else-if="service.icon === 'repos'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M3 3h12v12H3z" fill="#0078D4"/>
                                                <path d="M6 7l2 2-2 2M9 11h3" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- Artifacts -->
                                            <svg v-else-if="service.icon === 'artifacts'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 2l6 3v8l-6 3-6-3V5l6-3z" fill="#0078D4"/>
                                                <path d="M9 8l6-3M9 8v8M9 8L3 5" stroke="#50E6FF" stroke-width="1"/>
                                            </svg>

                                            <!-- ANALYTICS ICONS -->
                                            <!-- Synapse Analytics -->
                                            <svg v-else-if="service.icon === 'synapse'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <circle cx="9" cy="9" r="3" fill="#50E6FF"/>
                                                <path d="M9 2v4M9 12v4M2 9h4M12 9h4" stroke="#50E6FF" stroke-width="1.2"/>
                                            </svg>
                                            <!-- Data Factory -->
                                            <svg v-else-if="service.icon === 'data-factory'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="6" width="5" height="6" rx="1" fill="#0078D4"/>
                                                <rect x="11" y="6" width="5" height="6" rx="1" fill="#0078D4"/>
                                                <path d="M7 9h4" stroke="#50E6FF" stroke-width="2"/>
                                                <path d="M9 6V4M9 14v-2" stroke="#50E6FF" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Databricks -->
                                            <svg v-else-if="service.icon === 'databricks'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 1L1 5l8 4 8-4-8-4z" fill="#FF3621"/>
                                                <path d="M1 9l8 4 8-4" stroke="#FF3621" stroke-width="2"/>
                                                <path d="M1 13l8 4 8-4" stroke="#FF3621" stroke-width="2"/>
                                            </svg>
                                            <!-- Stream Analytics -->
                                            <svg v-else-if="service.icon === 'stream'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="14" height="14" rx="2" fill="#0078D4"/>
                                                <path d="M4 12l3-4 3 2 4-5" stroke="#50E6FF" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- HDInsight -->
                                            <svg v-else-if="service.icon === 'hdinsight'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 2l7 4v6l-7 4-7-4V6l7-4z" fill="#0078D4"/>
                                                <path d="M9 6l4 2v3l-4 2-4-2V8l4-2z" fill="#50E6FF"/>
                                            </svg>
                                            <!-- Power BI -->
                                            <svg v-else-if="service.icon === 'powerbi'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="3" y="8" width="3" height="7" rx="0.5" fill="#F2C811"/>
                                                <rect x="7.5" y="5" width="3" height="10" rx="0.5" fill="#F2C811"/>
                                                <rect x="12" y="2" width="3" height="13" rx="0.5" fill="#F2C811"/>
                                            </svg>

                                            <!-- INTEGRATION ICONS -->
                                            <!-- Logic Apps -->
                                            <svg v-else-if="service.icon === 'logic-apps'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="14" height="14" rx="2" fill="#0078D4"/>
                                                <path d="M5 9h2l1-2 2 4 1-2h2" stroke="#50E6FF" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- Service Bus -->
                                            <svg v-else-if="service.icon === 'service-bus'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="4" width="14" height="10" rx="1" fill="#0078D4"/>
                                                <path d="M5 7h8M5 9h8M5 11h8" stroke="#50E6FF" stroke-width="1.2"/>
                                            </svg>
                                            <!-- Event Grid -->
                                            <svg v-else-if="service.icon === 'event-grid'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="5" height="5" rx="1" fill="#0078D4"/>
                                                <rect x="11" y="2" width="5" height="5" rx="1" fill="#50E6FF"/>
                                                <rect x="2" y="11" width="5" height="5" rx="1" fill="#50E6FF"/>
                                                <rect x="11" y="11" width="5" height="5" rx="1" fill="#0078D4"/>
                                            </svg>
                                            <!-- Event Hubs -->
                                            <svg v-else-if="service.icon === 'event-hubs'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <circle cx="9" cy="9" r="4" stroke="#50E6FF" stroke-width="1.5" fill="none"/>
                                                <circle cx="9" cy="9" r="1.5" fill="#50E6FF"/>
                                            </svg>
                                            <!-- API Management -->
                                            <svg v-else-if="service.icon === 'apim'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="3" width="14" height="12" rx="1" fill="#0078D4"/>
                                                <text x="9" y="11" text-anchor="middle" fill="white" font-size="6" font-weight="bold">API</text>
                                            </svg>

                                            <!-- MONITOR ICONS -->
                                            <!-- Azure Monitor -->
                                            <svg v-else-if="service.icon === 'monitor-icon'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#0078D4"/>
                                                <path d="M5 9h2l1-3 2 6 1-3h2" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- Log Analytics -->
                                            <svg v-else-if="service.icon === 'log-analytics'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="14" height="14" rx="2" fill="#0078D4"/>
                                                <path d="M5 6h8M5 9h6M5 12h4" stroke="#50E6FF" stroke-width="1.5"/>
                                            </svg>
                                            <!-- Application Insights -->
                                            <svg v-else-if="service.icon === 'app-insights'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <circle cx="9" cy="9" r="7" fill="#68217A"/>
                                                <path d="M6 9l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <!-- Alerts -->
                                            <svg v-else-if="service.icon === 'alerts'" class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <path d="M9 2L2 15h14L9 2z" fill="#FFC107"/>
                                                <path d="M9 7v4M9 12.5v1" stroke="#000" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>

                                            <!-- Default Icon -->
                                            <svg v-else class="w-7 h-7" viewBox="0 0 18 18" fill="none">
                                                <rect x="2" y="2" width="14" height="14" rx="2" fill="#0078D4"/>
                                                <path d="M6 9h6M9 6v6" stroke="white" stroke-width="1.5"/>
                                            </svg>
                                        </div>

                                        <!-- Service Name -->
                                        <div class="flex-1 min-w-0">
                                            <span class="text-sm font-medium text-navy-700 group-hover:text-primary-700 transition-colors truncate block">
                                                {{ service.name }}
                                            </span>
                                        </div>

                                        <!-- Tutorial Count Badge -->
                                        <span class="text-xs text-navy-400 group-hover:text-primary-600 transition-colors">
                                            {{ service.tutorials }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div v-else class="bg-white rounded-2xl shadow-sm border border-navy-100 p-12 text-center">
                        <div class="w-16 h-16 bg-navy-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-navy-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-navy-900 mb-2">No services found</h3>
                        <p class="text-navy-500 mb-6">Try adjusting your search or browse a different category</p>
                        <button
                            @click="searchQuery = ''; selectedCategory = 'all'"
                            class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors"
                        >
                            Clear Filters
                        </button>
                    </div>
                </main>
            </div>
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
