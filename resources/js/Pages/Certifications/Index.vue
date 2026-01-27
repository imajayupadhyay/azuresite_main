<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import CertificationCard from './Components/CertificationCard.vue';

const selectedLevel = ref('all');

const certifications = [
    // Foundation
    { 
        code: 'AZ-900', 
        name: 'Azure Fundamentals',
        level: 'foundation',
        description: 'Demonstrate foundational knowledge of cloud services and how those services are provided with Microsoft Azure.',
        duration: '1-2 months',
        difficulty: 'Beginner',
        skills: ['Cloud Concepts', 'Azure Services', 'Security & Compliance', 'Pricing & Support'],
        examLength: '60 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'AI-900', 
        name: 'Azure AI Fundamentals',
        level: 'foundation',
        description: 'Demonstrate fundamental AI concepts related to the development of software and services of Microsoft Azure.',
        duration: '1 month',
        difficulty: 'Beginner',
        skills: ['AI Workloads', 'ML Principles', 'Computer Vision', 'NLP'],
        examLength: '60 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'DP-900', 
        name: 'Azure Data Fundamentals',
        level: 'foundation',
        description: 'Demonstrate foundational knowledge of core data concepts and Microsoft Azure data services.',
        duration: '1 month',
        difficulty: 'Beginner',
        skills: ['Core Data Concepts', 'Relational Data', 'Non-relational Data', 'Analytics'],
        examLength: '60 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'SC-900', 
        name: 'Security, Compliance, and Identity Fundamentals',
        level: 'foundation',
        description: 'Demonstrate foundational knowledge on security, compliance, and identity concepts.',
        duration: '1 month',
        difficulty: 'Beginner',
        skills: ['Security Concepts', 'Azure Security', 'Compliance', 'Identity Services'],
        examLength: '60 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    // Associate
    { 
        code: 'AZ-104', 
        name: 'Azure Administrator',
        level: 'associate',
        description: 'Implement, manage, and monitor an organizations Microsoft Azure environment.',
        duration: '3-4 months',
        difficulty: 'Intermediate',
        skills: ['Identity Management', 'Storage', 'Compute', 'Virtual Networking', 'Monitoring'],
        examLength: '120 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'AZ-204', 
        name: 'Developing Solutions for Azure',
        level: 'associate',
        description: 'Design, build, test, and maintain cloud applications and services on Microsoft Azure.',
        duration: '3-4 months',
        difficulty: 'Intermediate',
        skills: ['Azure Compute', 'Azure Storage', 'Security', 'Monitoring', 'Integration'],
        examLength: '120 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'AZ-500', 
        name: 'Azure Security Engineer',
        level: 'associate',
        description: 'Implement security controls and threat protection, manage identity and access.',
        duration: '3-4 months',
        difficulty: 'Intermediate',
        skills: ['Identity & Access', 'Platform Protection', 'Security Operations', 'Data & Apps'],
        examLength: '120 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'DP-203', 
        name: 'Azure Data Engineer',
        level: 'associate',
        description: 'Design and implement the management, monitoring, security, and privacy of data.',
        duration: '3-4 months',
        difficulty: 'Intermediate',
        skills: ['Data Storage', 'Data Processing', 'Data Security', 'Monitoring'],
        examLength: '120 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'AI-102', 
        name: 'Designing and Implementing Azure AI Solution',
        level: 'associate',
        description: 'Build, manage, and deploy AI solutions that leverage Azure Cognitive Services and Azure AI.',
        duration: '3-4 months',
        difficulty: 'Intermediate',
        skills: ['Cognitive Services', 'Computer Vision', 'NLP', 'Knowledge Mining'],
        examLength: '120 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'AZ-400', 
        name: 'Designing and Implementing DevOps Solutions',
        level: 'associate',
        description: 'Design and implement strategies for collaboration, code, infrastructure, and security.',
        duration: '3-4 months',
        difficulty: 'Intermediate',
        skills: ['DevOps Strategy', 'Source Control', 'CI/CD', 'Security', 'Compliance'],
        examLength: '120 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    // Expert
    { 
        code: 'AZ-305', 
        name: 'Designing Microsoft Azure Infrastructure Solutions',
        level: 'expert',
        description: 'Design cloud and hybrid solutions that run on Microsoft Azure.',
        duration: '4-6 months',
        difficulty: 'Advanced',
        skills: ['Identity', 'Governance', 'Data Storage', 'Business Continuity', 'Infrastructure'],
        examLength: '120 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    },
    { 
        code: 'SC-100', 
        name: 'Cybersecurity Architect',
        level: 'expert',
        description: 'Design and evolve the cybersecurity strategy to protect organizations assets.',
        duration: '4-6 months',
        difficulty: 'Advanced',
        skills: ['Zero Trust', 'Governance Risk Compliance', 'Security Operations', 'Infrastructure'],
        examLength: '120 minutes',
        questions: '40-60',
        passingScore: '700/1000'
    }
];

const filteredCertifications = computed(() => {
    if (selectedLevel.value === 'all') {
        return certifications;
    }
    return certifications.filter(cert => cert.level === selectedLevel.value);
});
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-primary-50/30">
        <Head>
            <title>Azure Certifications - Microsoft Azure Exam Preparation | AzureSkill</title>
            <meta name="description" content="Prepare for 12 Microsoft Azure certifications including AZ-900, AZ-104, AZ-305. Complete exam guides, preparation resources, and learning paths for all levels." />
            <meta name="keywords" content="Azure certification, AZ-900, AZ-104, AZ-204, AZ-305, Microsoft certification, Azure exam preparation, cloud certification" />
        </Head>
        
        <Header />
        
        <!-- Hero Section -->
        <div class="relative pt-24 pb-12 bg-white overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-gradient-to-br from-primary-100/40 to-primary-200/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-gradient-to-tr from-primary-50/60 to-navy-100/30 rounded-full blur-3xl"></div>
                
                <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="cert-dots" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1" fill="#1e293b"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#cert-dots)"/>
                </svg>

                <svg class="absolute top-32 right-[15%] w-24 h-24 opacity-[0.04]" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" stroke="#0078d4" stroke-width="1" fill="none"/>
                    <circle cx="50" cy="50" r="30" stroke="#0078d4" stroke-width="1" fill="none"/>
                </svg>
            </div>

            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-primary-50 to-primary-100 border border-primary-200 mb-6">
                    <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <span class="text-sm font-semibold text-primary-700">{{ certifications.length }} Certifications Available</span>
                </div>

                <h1 class="text-4xl sm:text-5xl font-bold text-navy-900 mb-4">
                    Azure Certifications
                </h1>
                <p class="text-lg text-navy-600 max-w-2xl mx-auto mb-8">
                    Choose your certification path and advance your career with Microsoft Azure certifications. From beginner to expert level.
                </p>

                <!-- Filter Tabs -->
                <div class="inline-flex bg-white/80 backdrop-blur-lg rounded-2xl p-2 shadow-xl border-2 border-primary-200">
                    <button
                        @click="selectedLevel = 'all'"
                        class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300"
                        :class="selectedLevel === 'all' 
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg' 
                            : 'text-navy-600 hover:text-navy-900 hover:bg-primary-50'"
                    >
                        All Certifications
                    </button>
                    <button
                        @click="selectedLevel = 'foundation'"
                        class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300"
                        :class="selectedLevel === 'foundation' 
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg' 
                            : 'text-navy-600 hover:text-navy-900 hover:bg-primary-50'"
                    >
                        Foundation
                    </button>
                    <button
                        @click="selectedLevel = 'associate'"
                        class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300"
                        :class="selectedLevel === 'associate' 
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg' 
                            : 'text-navy-600 hover:text-navy-900 hover:bg-primary-50'"
                    >
                        Associate
                    </button>
                    <button
                        @click="selectedLevel = 'expert'"
                        class="px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-300"
                        :class="selectedLevel === 'expert' 
                            ? 'bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg' 
                            : 'text-navy-600 hover:text-navy-900 hover:bg-primary-50'"
                    >
                        Expert
                    </button>
                </div>
            </div>
        </div>

        <!-- Certifications Grid -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 translate-y-8"
                enter-to-class="opacity-100 translate-y-0"
                mode="out-in"
            >
                <div :key="selectedLevel" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <CertificationCard
                        v-for="(cert, index) in filteredCertifications"
                        :key="cert.code"
                        :certification="cert"
                        :index="index"
                    />
                </div>
            </transition>
        </div>

        <Footer />
    </div>
</template>
