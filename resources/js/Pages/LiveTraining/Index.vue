<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const currentStep = ref(1);
const selectedCategory = ref(null);
const selectedItems = ref([]);
const formData = ref({
    name: '',
    email: '',
    phone: '',
    experience: '',
    preferredTime: '',
    message: ''
});

const categories = [
    {
        id: 'certification',
        title: 'Certification Training',
        description: 'Prepare for Azure certifications with expert guidance',
        icon: 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
        color: 'from-blue-500 to-blue-600',
        items: [
            { 
                name: 'AZ-900', 
                description: 'Azure Fundamentals',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cert1" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><path fill="url(#cert1)" d="M9 1L2 5v5c0 4.5 3 6.5 7 8 4-1.5 7-3.5 7-8V5l-7-4z"/><text x="9" y="11" font-size="6" fill="#fff" text-anchor="middle" font-weight="bold">900</text></svg>',
                level: 'Fundamental'
            },
            { 
                name: 'AZ-104', 
                description: 'Azure Administrator',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cert2" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#50e6ff"/></linearGradient></defs><rect x="2" y="2" width="14" height="14" rx="2" fill="url(#cert2)"/><text x="9" y="12" font-size="5" fill="#fff" text-anchor="middle" font-weight="bold">104</text></svg>',
                level: 'Associate'
            },
            { 
                name: 'AZ-204', 
                description: 'Azure Developer',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cert3" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#3c91e5"/></linearGradient></defs><circle cx="9" cy="9" r="7" fill="url(#cert3)"/><text x="9" y="12" font-size="5" fill="#fff" text-anchor="middle" font-weight="bold">204</text></svg>',
                level: 'Associate'
            },
            { 
                name: 'AZ-305', 
                description: 'Azure Solutions Architect',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cert4" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><path fill="url(#cert4)" d="M9 1l8 4.5v9L9 19l-8-4.5v-9L9 1z"/><text x="9" y="12" font-size="5" fill="#fff" text-anchor="middle" font-weight="bold">305</text></svg>',
                level: 'Expert'
            },
            { 
                name: 'AZ-500', 
                description: 'Azure Security Engineer',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cert5" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#d83b01"/><stop offset="1" stop-color="#ff8c00"/></linearGradient></defs><path fill="url(#cert5)" d="M9 1L2 5v5c0 4.5 3 6.5 7 8 4-1.5 7-3.5 7-8V5l-7-4z"/><text x="9" y="12" font-size="5" fill="#fff" text-anchor="middle" font-weight="bold">500</text></svg>',
                level: 'Associate'
            },
            { 
                name: 'DP-203', 
                description: 'Data Engineering',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cert6" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#50e6ff"/></linearGradient></defs><ellipse cx="9" cy="5" rx="6" ry="3" fill="url(#cert6)"/><path d="M3 5v8c0 1.66 2.69 3 6 3s6-1.34 6-3V5" fill="#5ea0ef"/><text x="9" y="11" font-size="4" fill="#fff" text-anchor="middle" font-weight="bold">203</text></svg>',
                level: 'Associate'
            },
            { 
                name: 'AI-102', 
                description: 'AI Engineer',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cert7" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><circle cx="9" cy="9" r="7" fill="url(#cert7)"/><circle cx="6.5" cy="7.5" r="1.5" fill="#fff"/><circle cx="11.5" cy="7.5" r="1.5" fill="#fff"/><path d="M6 11.5q3 2 6 0" stroke="#fff" stroke-width="1.5" fill="none"/></svg>',
                level: 'Associate'
            },
            { 
                name: 'AZ-400', 
                description: 'DevOps Engineer',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cert8" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><path fill="url(#cert8)" d="M13 1L5 2v14l8 1V1z"/><path fill="#50e6ff" d="M5 2L1 4v10l4 2V2z"/><text x="9" y="11" font-size="4.5" fill="#fff" text-anchor="middle" font-weight="bold">400</text></svg>',
                level: 'Expert'
            }
        ]
    },
    {
        id: 'project',
        title: 'Project-Based Training',
        description: 'Learn by building real-world Azure projects',
        icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        color: 'from-green-500 to-green-600',
        items: [
            { 
                name: 'E-Commerce App', 
                description: 'Full-stack online store',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="proj1" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#107c10"/><stop offset="1" stop-color="#5ea000"/></linearGradient></defs><path fill="url(#proj1)" d="M2 2h14v3H2z"/><rect x="3" y="6" width="5" height="9" rx="1" fill="#5ea000"/><rect x="10" y="6" width="5" height="9" rx="1" fill="#107c10"/></svg>',
                duration: '8 weeks'
            },
            { 
                name: 'IoT Solution', 
                description: 'Connected device platform',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="proj2" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#107c10"/><stop offset="1" stop-color="#5ea000"/></linearGradient></defs><circle cx="9" cy="9" r="2" fill="url(#proj2)"/><circle cx="4" cy="9" r="1.5" fill="#5ea000"/><circle cx="14" cy="9" r="1.5" fill="#5ea000"/><circle cx="9" cy="4" r="1.5" fill="#107c10"/><circle cx="9" cy="14" r="1.5" fill="#107c10"/></svg>',
                duration: '6 weeks'
            },
            { 
                name: 'Data Analytics Platform', 
                description: 'Big data processing & visualization',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="proj3" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#107c10"/><stop offset="1" stop-color="#5ea000"/></linearGradient></defs><rect x="2" y="10" width="3" height="6" rx="1" fill="url(#proj3)"/><rect x="7" y="7" width="3" height="9" rx="1" fill="#5ea000"/><rect x="12" y="4" width="3" height="12" rx="1" fill="#107c10"/></svg>',
                duration: '10 weeks'
            },
            { 
                name: 'Serverless Apps', 
                description: 'Event-driven applications',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="proj4" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#107c10"/><stop offset="1" stop-color="#5ea000"/></linearGradient></defs><path fill="url(#proj4)" d="M9 2l-7 5 7 5 7-5-7-5z"/><path fill="#5ea000" d="M9 12l-5 3v1l5 2 5-2v-1l-5-3z"/></svg>',
                duration: '5 weeks'
            },
            { 
                name: 'Microservices Architecture', 
                description: 'Distributed system design',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="proj5" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#107c10"/><stop offset="1" stop-color="#5ea000"/></linearGradient></defs><rect x="2" y="2" width="5" height="5" rx="1" fill="url(#proj5)"/><rect x="11" y="2" width="5" height="5" rx="1" fill="#5ea000"/><rect x="2" y="11" width="5" height="5" rx="1" fill="#5ea000"/><rect x="11" y="11" width="5" height="5" rx="1" fill="url(#proj5)"/></svg>',
                duration: '12 weeks'
            },
            { 
                name: 'DevOps Pipeline', 
                description: 'Complete CI/CD implementation',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="proj6" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#107c10"/><stop offset="1" stop-color="#5ea000"/></linearGradient></defs><circle cx="3" cy="9" r="2" fill="url(#proj6)"/><circle cx="9" cy="9" r="2" fill="#5ea000"/><circle cx="15" cy="9" r="2" fill="url(#proj6)"/><path stroke="#107c10" stroke-width="2" d="M5 9h2M11 9h2"/></svg>',
                duration: '7 weeks'
            }
        ]
    },
    {
        id: 'services',
        title: 'Azure Services Training',
        description: 'Deep dive into specific Azure services',
        icon: 'M5 12.5c0-2.5 2-4.5 4.5-4.5 .5-2.5 2.5-4 5-4 3 0 5.5 2.5 5.5 5.5 0 .2 0 .3 0 .5 1.5.5 2.5 2 2.5 3.5 0 2-1.5 4-4 4H6c-2.5 0-4-2-4-4 0-1.5 1-3 3-3.5',
        color: 'from-purple-500 to-purple-600',
        items: [
            { 
                name: 'Virtual Machines', 
                description: 'IaaS compute service',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><path d="M10.427 1.427L15.854 3.64v10.721l-5.427 2.213V1.427z" fill="#0078D4"/><path d="M5 3.64l5.427-2.213v15.147L5 14.36V3.64z" fill="#50E6FF"/><path d="M0 5.853L5 3.64v10.721l-5 2.213V5.853z" fill="#C3F1FF"/></svg>'
            },
            { 
                name: 'App Service', 
                description: 'PaaS for web apps',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="app-service" x1="9" y1="15.791" x2="9" y2="1.603"><stop offset="0" stop-color="#0078d4"/><stop offset=".16" stop-color="#1380da"/><stop offset=".53" stop-color="#3c91e5"/><stop offset=".82" stop-color="#559cec"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><path fill="url(#app-service)" d="M1.6 11.6h3.8L1.5 3.2 9 1.6l3.2 8.4h3.3L9 15.8z"/></svg>'
            },
            { 
                name: 'Azure Functions', 
                description: 'Serverless compute',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="functions" x1="9" y1="16.97" x2="9" y2="1.03"><stop offset="0" stop-color="#ffb900"/><stop offset="1" stop-color="#ffd75e"/></linearGradient></defs><path fill="url(#functions)" d="M15.4 6.6l-1.6-.7V3.5c0-.6-.4-1-1-1H9.2L8.5 1c-.1-.5-.5-.9-1-.9s-.9.4-1 .9l-.7 1.5H2.2c-.6 0-1 .4-1 1v2.4l-1.1.5c-.5.2-.8.7-.6 1.2s.7.8 1.2.6l1.6-.7v2.1l-1.6.7c-.5.2-.8.7-.6 1.2s.7.8 1.2.6l1.1-.5v2.4c0 .6.4 1 1 1h3.6l.7 1.5c.1.5.5.9 1 .9s.9-.4 1-.9l.7-1.5h3.6c.6 0 1-.4 1-1v-2.4l1.6-.7c.5-.2.8-.7.6-1.2s-.7-.8-1.2-.6z"/></svg>'
            },
            { 
                name: 'Kubernetes Service', 
                description: 'Managed K8s',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="aks" x1="8.907" y1="12.98" x2="8.907" y2="1.703"><stop offset="0" stop-color="#0078d4"/><stop offset=".16" stop-color="#1380da"/><stop offset=".53" stop-color="#3c91e5"/><stop offset=".82" stop-color="#559cec"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><path fill="url(#aks)" d="M14.926 6.434l-5.09-4.66a1.166 1.166 0 0 0-1.581 0l-5.09 4.66a1.169 1.169 0 0 0-.353 1.094l1.95 6.003a1.167 1.167 0 0 0 1.109.812h6.22a1.167 1.167 0 0 0 1.109-.812l1.95-6.003a1.169 1.169 0 0 0-.353-1.094z"/></svg>'
            },
            { 
                name: 'SQL Database', 
                description: 'Managed SQL Server',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sql" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><ellipse cx="9" cy="4" rx="7" ry="3" fill="url(#sql)"/><path d="M2 4v4c0 1.66 3.13 3 7 3s7-1.34 7-3V4" fill="#50e6ff"/><path d="M2 8v4c0 1.66 3.13 3 7 3s7-1.34 7-3V8" fill="url(#sql)"/></svg>'
            },
            { 
                name: 'Cosmos DB', 
                description: 'NoSQL database',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="cosmos" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><circle cx="9" cy="9" r="7.5" fill="url(#cosmos)"/><path d="M9 2a7 7 0 0 1 0 14M9 16a7 7 0 0 1 0-14" stroke="#50e6ff" stroke-width="1.5" fill="none"/><circle cx="9" cy="9" r="1.5" fill="#fff"/></svg>'
            },
            { 
                name: 'Azure AD', 
                description: 'Identity management',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="ad" x1="9" y1="17" x2="9" y2="1"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><circle cx="9" cy="6" r="3" fill="url(#ad)"/><path d="M4 16c0-2.76 2.24-5 5-5s5 2.24 5 5" fill="#50e6ff"/></svg>'
            },
            { 
                name: 'Key Vault', 
                description: 'Secrets management',
                icon: '<svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="kv" x1="9" y1="16" x2="9" y2="2"><stop offset="0" stop-color="#0078d4"/><stop offset="1" stop-color="#5ea0ef"/></linearGradient></defs><rect x="4" y="6" width="10" height="9" rx="1" fill="url(#kv)"/><path d="M9 2a3 3 0 0 1 3 3v1H6V5a3 3 0 0 1 3-3z" fill="#50e6ff"/><circle cx="9" cy="10.5" r="1.5" fill="#fff"/><rect x="8.5" y="10.5" width="1" height="2" fill="#fff"/></svg>'
            }
        ]
    }
];

const selectCategory = (categoryId) => {
    selectedCategory.value = categoryId;
    selectedItems.value = [];
    currentStep.value = 2;
};

const toggleItem = (item) => {
    const itemName = typeof item === 'string' ? item : item.name;
    const index = selectedItems.value.findIndex(i => {
        const name = typeof i === 'string' ? i : i.name;
        return name === itemName;
    });
    if (index > -1) {
        selectedItems.value.splice(index, 1);
    } else {
        selectedItems.value.push(item);
    }
};

const isItemSelected = (item) => {
    const itemName = typeof item === 'string' ? item : item.name;
    return selectedItems.value.some(i => {
        const name = typeof i === 'string' ? i : i.name;
        return name === itemName;
    });
};

const goToForm = () => {
    if (selectedItems.value.length > 0) {
        currentStep.value = 3;
    }
};

const submitForm = () => {
    const data = {
        category: selectedCategory.value,
        items: selectedItems.value,
        ...formData.value
    };
    console.log('Form submitted:', data);
    alert('Thank you for your interest! Our team will contact you within 24 hours.');
    // Reset
    currentStep.value = 1;
    selectedCategory.value = null;
    selectedItems.value = [];
    formData.value = {
        name: '',
        email: '',
        phone: '',
        experience: '',
        preferredTime: '',
        message: ''
    };
};

const goBack = () => {
    if (currentStep.value > 1) {
        currentStep.value--;
    }
};

const selectedCategoryData = computed(() => {
    return categories.find(c => c.id === selectedCategory.value);
});

const progressPercentage = computed(() => {
    return (currentStep.value / 3) * 100;
});
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-primary-50/30">
        <Head>
            <title>Live Training - Interactive Azure Learning | AzureSkill</title>
            <meta name="description" content="Join our live Azure training sessions. Choose from certification preparation, project-based learning, or specific Azure services training with expert instructors." />
            <meta name="keywords" content="Azure live training, Azure bootcamp, Azure certification training, live Azure courses, Azure instructor-led training" />
        </Head>
        
        <Header />
        
        <!-- Hero Section -->
        <div class="relative pt-24 pb-12 bg-gradient-to-r from-primary-600 to-primary-700 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="url(#grid)" />
                    <defs>
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                </svg>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 backdrop-blur-lg border border-white/30 mb-6">
                    <svg class="w-4 h-4 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-semibold text-white">Live Interactive Sessions</span>
                </div>

                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
                    Live Azure Training
                </h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                    Join our expert-led live training sessions. Learn Azure with hands-on guidance and real-time support.
                </p>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="sticky top-16 z-40 bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-semibold text-navy-900">Step {{ currentStep }} of 3</span>
                    <span class="text-sm text-navy-600">{{ progressPercentage.toFixed(0) }}% Complete</span>
                </div>
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div 
                        class="h-full bg-gradient-to-r from-primary-500 to-primary-600 transition-all duration-500 ease-out"
                        :style="{ width: `${progressPercentage}%` }"
                    ></div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <!-- Step 1: Choose Category -->
            <div v-if="currentStep === 1">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-navy-900 mb-3">Choose Your Learning Path</h2>
                    <p class="text-lg text-navy-600">Select the type of training that suits your goals</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div
                        v-for="category in categories"
                        :key="category.id"
                        @click="selectCategory(category.id)"
                        class="group relative bg-white rounded-2xl border-2 border-gray-200 hover:border-primary-400 p-8 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 cursor-pointer"
                    >
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-50/0 to-primary-100/0 group-hover:from-primary-50/50 group-hover:to-primary-100/30 rounded-2xl transition-all duration-300"></div>
                        
                        <div class="relative">
                            <div 
                                class="w-16 h-16 rounded-xl bg-gradient-to-br flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300"
                                :class="category.color"
                            >
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="category.icon"/>
                                </svg>
                            </div>

                            <h3 class="text-2xl font-bold text-navy-900 mb-3 group-hover:text-primary-600 transition-colors">
                                {{ category.title }}
                            </h3>
                            <p class="text-navy-600 mb-6">
                                {{ category.description }}
                            </p>

                            <div class="flex items-center text-primary-600 font-semibold group-hover:text-primary-700">
                                <span>Get Started</span>
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Select Items -->
            <div v-if="currentStep === 2 && selectedCategoryData">
                <div class="mb-8">
                    <button 
                        @click="goBack"
                        class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold mb-6"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back
                    </button>

                    <div class="text-center mb-12">
                        <div 
                            class="inline-flex w-20 h-20 rounded-2xl bg-gradient-to-br items-center justify-center mb-4 shadow-lg"
                            :class="selectedCategoryData.color"
                        >
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" :d="selectedCategoryData.icon"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-navy-900 mb-3">{{ selectedCategoryData.title }}</h2>
                        <p class="text-lg text-navy-600">Select the topics you want to learn (multiple selection allowed)</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div
                        v-for="item in selectedCategoryData.items"
                        :key="typeof item === 'string' ? item : item.name"
                        @click="toggleItem(item)"
                        class="relative group cursor-pointer"
                    >
                        <div 
                            class="relative p-6 rounded-2xl border-2 transition-all duration-300 hover:-translate-y-1"
                            :class="isItemSelected(item)
                                ? 'bg-gradient-to-br from-primary-50 to-primary-100/50 border-primary-500 shadow-xl'
                                : 'bg-white border-gray-200 hover:border-primary-300 hover:shadow-lg'"
                        >
                            <!-- Checkbox -->
                            <div 
                                class="absolute top-4 right-4 w-6 h-6 rounded-md border-2 flex items-center justify-center transition-all z-10"
                                :class="isItemSelected(item)
                                    ? 'bg-primary-600 border-primary-600'
                                    : 'border-gray-300 group-hover:border-primary-400'"
                            >
                                <svg 
                                    v-if="isItemSelected(item)"
                                    class="w-4 h-4 text-white" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>

                            <!-- Icon -->
                            <div 
                                class="w-16 h-16 mb-4 flex items-center justify-center rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 group-hover:scale-110 transition-transform duration-300 shadow-md"
                                :class="isItemSelected(item) ? 'ring-2 ring-primary-400 ring-offset-2' : ''"
                            >
                                <div v-if="typeof item === 'object' && item.icon" v-html="item.icon" class="w-12 h-12"></div>
                                <svg v-else class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>

                            <!-- Content -->
                            <div class="space-y-2">
                                <h4 
                                    class="text-lg font-bold transition-colors leading-tight"
                                    :class="isItemSelected(item) ? 'text-primary-700' : 'text-navy-900 group-hover:text-primary-600'"
                                >
                                    {{ typeof item === 'string' ? item : item.name }}
                                </h4>
                                
                                <p 
                                    v-if="typeof item === 'object' && item.description"
                                    class="text-sm text-navy-600 line-clamp-2"
                                >
                                    {{ item.description }}
                                </p>

                                <!-- Badge for certifications -->
                                <div v-if="typeof item === 'object' && item.level" class="pt-2">
                                    <span 
                                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold"
                                        :class="{
                                            'bg-blue-100 text-blue-700': item.level === 'Fundamental',
                                            'bg-green-100 text-green-700': item.level === 'Associate',
                                            'bg-purple-100 text-purple-700': item.level === 'Expert'
                                        }"
                                    >
                                        {{ item.level }}
                                    </span>
                                </div>

                                <!-- Badge for projects -->
                                <div v-if="typeof item === 'object' && item.duration" class="pt-2">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-100 text-amber-700">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ item.duration }}
                                    </span>
                                </div>
                            </div>

                            <!-- Hover effect overlay -->
                            <div 
                                class="absolute inset-0 rounded-2xl bg-gradient-to-br from-primary-400/0 to-primary-600/0 group-hover:from-primary-400/5 group-hover:to-primary-600/10 transition-all duration-300 pointer-events-none"
                                :class="isItemSelected(item) ? 'from-primary-400/10 to-primary-600/20' : ''"
                            ></div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-sm text-navy-600 mb-4">{{ selectedItems.length }} item(s) selected</p>
                    <button
                        @click="goToForm"
                        :disabled="selectedItems.length === 0"
                        class="px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 disabled:from-gray-300 disabled:to-gray-400 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 disabled:scale-100 disabled:cursor-not-allowed shadow-lg"
                    >
                        Continue to Registration
                    </button>
                </div>
            </div>

            <!-- Step 3: Registration Form -->
            <div v-if="currentStep === 3">
                <div class="mb-8">
                    <button 
                        @click="goBack"
                        class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold mb-6"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back
                    </button>
                </div>

                <div class="max-w-3xl mx-auto">
                    <div class="bg-white rounded-3xl shadow-xl border-2 border-gray-200 overflow-hidden">
                        <!-- Form Header -->
                        <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-6">
                            <h2 class="text-2xl font-bold text-white mb-2">Complete Your Registration</h2>
                            <p class="text-primary-100">We'll contact you within 24 hours to schedule your training</p>
                        </div>

                        <!-- Selected Items Summary -->
                        <div class="px-8 py-6 bg-primary-50 border-b border-primary-100">
                            <h3 class="text-sm font-semibold text-navy-900 mb-3">Your Selected Topics:</h3>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    v-for="item in selectedItems"
                                    :key="typeof item === 'string' ? item : item.name"
                                    class="inline-flex items-center px-3 py-1.5 bg-white border border-primary-200 text-primary-700 text-sm font-medium rounded-lg"
                                >
                                    <span v-if="typeof item === 'object' && item.icon" v-html="item.icon" class="w-5 h-5 mr-2"></span>
                                    {{ typeof item === 'string' ? item : item.name }}
                                </span>
                            </div>
                        </div>

                        <!-- Form -->
                        <form @submit.prevent="submitForm" class="p-8 space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Full Name *</label>
                                    <input 
                                        v-model="formData.name"
                                        type="text" 
                                        required
                                        placeholder="John Doe"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Email Address *</label>
                                    <input 
                                        v-model="formData.email"
                                        type="email" 
                                        required
                                        placeholder="john@example.com"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Phone Number *</label>
                                    <input 
                                        v-model="formData.phone"
                                        type="tel" 
                                        required
                                        placeholder="+1 234 567 8900"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-navy-900 mb-2">Azure Experience *</label>
                                    <select 
                                        v-model="formData.experience"
                                        required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                    >
                                        <option value="">Select your level</option>
                                        <option value="beginner">Beginner (0-6 months)</option>
                                        <option value="intermediate">Intermediate (6 months - 2 years)</option>
                                        <option value="advanced">Advanced (2+ years)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-navy-900 mb-2">Preferred Training Time *</label>
                                <select 
                                    v-model="formData.preferredTime"
                                    required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                                >
                                    <option value="">Select preferred time</option>
                                    <option value="weekday-morning">Weekday Morning (9 AM - 12 PM)</option>
                                    <option value="weekday-afternoon">Weekday Afternoon (2 PM - 5 PM)</option>
                                    <option value="weekday-evening">Weekday Evening (6 PM - 9 PM)</option>
                                    <option value="weekend">Weekend Sessions</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-navy-900 mb-2">Additional Message</label>
                                <textarea 
                                    v-model="formData.message"
                                    rows="4"
                                    placeholder="Tell us about your learning goals or any specific requirements..."
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none"
                                ></textarea>
                            </div>

                            <button 
                                type="submit"
                                class="w-full px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg"
                            >
                                Submit Registration
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <Footer />
    </div>
</template>
