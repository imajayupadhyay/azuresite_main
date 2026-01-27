<script setup>
import { ref } from 'vue';

const activeCategory = ref('compute');

const categories = [
    { id: 'compute', name: 'Compute', icon: 'M19 12h-2M19 12a7 7 0 0 1-7 7m7-7a7 7 0 0 0-7-7m0 14a7 7 0 0 1-7-7m7 7v2m-7-9H3m4.5-5.5L5 5' },
    { id: 'storage', name: 'Storage', icon: 'M4 6h16M4 10h16M4 14h16M4 18h16' },
    { id: 'networking', name: 'Networking', icon: 'M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z' },
    { id: 'database', name: 'Databases', icon: 'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5' },
    { id: 'ai', name: 'AI + ML', icon: 'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5' },
    { id: 'security', name: 'Security', icon: 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z' },
    { id: 'devops', name: 'DevOps', icon: 'M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6' },
    { id: 'web', name: 'Web & Mobile', icon: 'M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z' },
];

const services = {
    compute: [
        { name: 'Virtual Machines', description: 'Provision Windows and Linux VMs', color: 'from-blue-500 to-blue-600', tutorials: 24 },
        { name: 'App Service', description: 'Build and host web apps', color: 'from-cyan-500 to-cyan-600', tutorials: 18 },
        { name: 'Azure Functions', description: 'Serverless compute service', color: 'from-yellow-500 to-yellow-600', tutorials: 15 },
        { name: 'Container Instances', description: 'Run containers without managing servers', color: 'from-indigo-500 to-indigo-600', tutorials: 12 },
        { name: 'Kubernetes Service', description: 'Managed Kubernetes service', color: 'from-blue-600 to-blue-700', tutorials: 20 },
        { name: 'Azure Batch', description: 'Cloud-scale job scheduling', color: 'from-purple-500 to-purple-600', tutorials: 8 },
    ],
    storage: [
        { name: 'Blob Storage', description: 'Massively scalable object storage', color: 'from-orange-500 to-orange-600', tutorials: 16 },
        { name: 'File Storage', description: 'Managed file shares', color: 'from-red-500 to-red-600', tutorials: 10 },
        { name: 'Queue Storage', description: 'Messaging for cloud solutions', color: 'from-pink-500 to-pink-600', tutorials: 8 },
        { name: 'Table Storage', description: 'NoSQL key-value store', color: 'from-rose-500 to-rose-600', tutorials: 7 },
        { name: 'Disk Storage', description: 'Persistent disks for VMs', color: 'from-amber-500 to-amber-600', tutorials: 9 },
        { name: 'Data Lake Storage', description: 'Scalable data lake solution', color: 'from-teal-500 to-teal-600', tutorials: 11 },
    ],
    networking: [
        { name: 'Virtual Network', description: 'Private network in Azure', color: 'from-blue-500 to-blue-600', tutorials: 14 },
        { name: 'Load Balancer', description: 'High availability and network performance', color: 'from-indigo-500 to-indigo-600', tutorials: 10 },
        { name: 'Application Gateway', description: 'Web traffic load balancer', color: 'from-violet-500 to-violet-600', tutorials: 12 },
        { name: 'VPN Gateway', description: 'Secure cross-premises connectivity', color: 'from-cyan-500 to-cyan-600', tutorials: 9 },
        { name: 'Azure CDN', description: 'Content delivery network', color: 'from-sky-500 to-sky-600', tutorials: 8 },
        { name: 'Traffic Manager', description: 'DNS-based traffic routing', color: 'from-blue-600 to-blue-700', tutorials: 7 },
    ],
    database: [
        { name: 'SQL Database', description: 'Managed relational database', color: 'from-red-500 to-red-600', tutorials: 22 },
        { name: 'Cosmos DB', description: 'Globally distributed database', color: 'from-purple-500 to-purple-600', tutorials: 18 },
        { name: 'MySQL Database', description: 'Managed MySQL service', color: 'from-blue-500 to-blue-600', tutorials: 14 },
        { name: 'PostgreSQL', description: 'Managed PostgreSQL service', color: 'from-indigo-500 to-indigo-600', tutorials: 13 },
        { name: 'SQL Managed Instance', description: 'Fully managed SQL Server', color: 'from-pink-500 to-pink-600', tutorials: 11 },
        { name: 'Redis Cache', description: 'In-memory data cache', color: 'from-orange-500 to-orange-600', tutorials: 9 },
    ],
    ai: [
        { name: 'Cognitive Services', description: 'AI APIs for vision, speech, language', color: 'from-purple-500 to-purple-600', tutorials: 19 },
        { name: 'Machine Learning', description: 'Build and deploy ML models', color: 'from-blue-500 to-blue-600', tutorials: 25 },
        { name: 'Bot Service', description: 'Intelligent bot development', color: 'from-cyan-500 to-cyan-600', tutorials: 12 },
        { name: 'Azure OpenAI', description: 'Access to GPT models', color: 'from-green-500 to-green-600', tutorials: 20 },
        { name: 'Computer Vision', description: 'Image and video analysis', color: 'from-indigo-500 to-indigo-600', tutorials: 15 },
        { name: 'Form Recognizer', description: 'Document data extraction', color: 'from-pink-500 to-pink-600', tutorials: 10 },
    ],
    security: [
        { name: 'Key Vault', description: 'Safeguard cryptographic keys', color: 'from-yellow-500 to-yellow-600', tutorials: 13 },
        { name: 'Security Center', description: 'Unified security management', color: 'from-red-500 to-red-600', tutorials: 16 },
        { name: 'Azure AD', description: 'Identity and access management', color: 'from-blue-500 to-blue-600', tutorials: 21 },
        { name: 'Azure Sentinel', description: 'Cloud-native SIEM', color: 'from-purple-500 to-purple-600', tutorials: 14 },
        { name: 'DDoS Protection', description: 'DDoS mitigation service', color: 'from-orange-500 to-orange-600', tutorials: 8 },
        { name: 'Azure Firewall', description: 'Cloud-native firewall', color: 'from-indigo-500 to-indigo-600', tutorials: 11 },
    ],
    devops: [
        { name: 'Azure DevOps', description: 'Complete DevOps toolchain', color: 'from-blue-500 to-blue-600', tutorials: 28 },
        { name: 'Azure Pipelines', description: 'CI/CD that works with any language', color: 'from-cyan-500 to-cyan-600', tutorials: 22 },
        { name: 'Azure Repos', description: 'Unlimited cloud-hosted Git repos', color: 'from-green-500 to-green-600', tutorials: 12 },
        { name: 'Azure Boards', description: 'Agile planning and tracking', color: 'from-indigo-500 to-indigo-600', tutorials: 10 },
        { name: 'Azure Artifacts', description: 'Package management', color: 'from-purple-500 to-purple-600', tutorials: 8 },
        { name: 'Azure Test Plans', description: 'Manual and exploratory testing', color: 'from-pink-500 to-pink-600', tutorials: 9 },
    ],
    web: [
        { name: 'Static Web Apps', description: 'Modern web app hosting', color: 'from-purple-500 to-purple-600', tutorials: 15 },
        { name: 'API Management', description: 'Publish APIs to developers', color: 'from-blue-500 to-blue-600', tutorials: 17 },
        { name: 'Notification Hubs', description: 'Push notifications at scale', color: 'from-orange-500 to-orange-600', tutorials: 9 },
        { name: 'SignalR Service', description: 'Real-time web functionality', color: 'from-cyan-500 to-cyan-600', tutorials: 11 },
        { name: 'Azure Maps', description: 'Location intelligence APIs', color: 'from-green-500 to-green-600', tutorials: 8 },
        { name: 'Azure Search', description: 'AI-powered search service', color: 'from-indigo-500 to-indigo-600', tutorials: 13 },
    ],
};
</script>

<template>
    <section class="relative py-20 bg-white overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Subtle Grid -->
            <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle at 1px 1px, rgb(15, 23, 42) 1px, transparent 0); background-size: 40px 40px;"></div>
            
            <!-- Gradient Orbs -->
            <div class="absolute top-20 -right-40 w-96 h-96 bg-gradient-to-br from-primary-200/20 to-primary-300/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-primary-100/20 to-navy-200/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-50 border border-primary-100 mb-4">
                    <svg class="w-4 h-4 text-primary-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    <span class="text-sm font-semibold text-primary-700">200+ Tutorials Available</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-bold text-navy-950 mb-4">
                    Explore Azure Services
                </h2>
                <p class="text-lg text-navy-600 max-w-2xl mx-auto">
                    Comprehensive tutorials for every Azure service. From basics to advanced concepts.
                </p>
            </div>

            <!-- Horizontal Tab Navigation -->
            <div class="mb-8">
                <div class="relative">
                    <!-- Scrollable Tab Container -->
                    <div class="overflow-x-auto scrollbar-hide">
                        <div class="flex space-x-2 pb-4 min-w-max">
                            <button
                                v-for="category in categories"
                                :key="category.id"
                                @click="activeCategory = category.id"
                                class="group relative flex items-center px-6 py-3.5 rounded-2xl font-semibold text-sm transition-all duration-300 whitespace-nowrap"
                                :class="activeCategory === category.id 
                                    ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg shadow-primary-600/30 scale-105' 
                                    : 'bg-navy-50 text-navy-700 hover:bg-navy-100 hover:text-navy-900 hover:scale-105'"
                            >
                                <svg 
                                    class="w-5 h-5 mr-2 transition-transform duration-300"
                                    :class="activeCategory === category.id ? 'scale-110' : 'group-hover:scale-110'"
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="category.icon"/>
                                </svg>
                                {{ category.name }}
                                
                                <!-- Active Indicator -->
                                <div 
                                    v-if="activeCategory === category.id"
                                    class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-white rounded-full shadow-lg"
                                ></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Grid with Transition -->
            <transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 translate-y-8"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-all duration-300 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-8"
                mode="out-in"
            >
                <div :key="activeCategory" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="(service, index) in services[activeCategory]"
                        :key="service.name"
                        class="group relative bg-white rounded-2xl border-2 border-navy-100 hover:border-primary-300 p-6 transition-all duration-300 hover:shadow-2xl hover:shadow-primary-600/10 hover:-translate-y-2 cursor-pointer"
                        :style="{ transitionDelay: `${index * 50}ms` }"
                    >
                        <!-- Gradient Background on Hover -->
                        <div class="absolute inset-0 bg-gradient-to-br opacity-0 group-hover:opacity-5 rounded-2xl transition-opacity duration-300"
                            :class="service.color"
                        ></div>

                        <!-- Service Icon -->
                        <div class="relative mb-4 flex items-start justify-between">
                            <div 
                                class="w-14 h-14 rounded-xl bg-gradient-to-br flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-300"
                                :class="service.color"
                            >
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.5c0-2.5 2-4.5 4.5-4.5 .5-2.5 2.5-4 5-4 3 0 5.5 2.5 5.5 5.5 0 .2 0 .3 0 .5 1.5.5 2.5 2 2.5 3.5 0 2-1.5 4-4 4H6c-2.5 0-4-2-4-4 0-1.5 1-3 3-3.5"/>
                                </svg>
                            </div>

                            <!-- Tutorial Count Badge -->
                            <div class="flex items-center px-3 py-1 rounded-full bg-primary-50 border border-primary-200">
                                <svg class="w-3.5 h-3.5 text-primary-600 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                                <span class="text-xs font-bold text-primary-700">{{ service.tutorials }}</span>
                            </div>
                        </div>

                        <!-- Service Info -->
                        <div class="relative">
                            <h3 class="text-lg font-bold text-navy-900 mb-2 group-hover:text-primary-700 transition-colors">
                                {{ service.name }}
                            </h3>
                            <p class="text-sm text-navy-600 mb-4 leading-relaxed">
                                {{ service.description }}
                            </p>

                            <!-- CTA Link -->
                            <div class="flex items-center text-primary-600 font-semibold text-sm group-hover:text-primary-700">
                                <span>Start Learning</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Shine Effect -->
                        <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                            <div class="absolute inset-0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                        </div>
                    </div>
                </div>
            </transition>

            <!-- View All Button -->
            <div class="text-center mt-12">
                <a
                    href="/tutorials"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-2xl shadow-lg shadow-primary-600/30 hover:shadow-xl hover:shadow-primary-600/40 transition-all duration-300 hover:scale-105 active:scale-95"
                >
                    <span>View All Tutorials</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
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
