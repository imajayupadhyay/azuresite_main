<script setup>
import { ref } from 'vue';

const emit = defineEmits(['category-select']);

const categories = [
    {
        id: 'account',
        title: 'Account & Billing',
        description: 'Manage your account, subscriptions, and payment',
        icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
        color: 'from-blue-500 to-blue-600',
        articles: 12
    },
    {
        id: 'technical',
        title: 'Technical Support',
        description: 'Get help with Azure services and configurations',
        icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
        color: 'from-green-500 to-green-600',
        articles: 28
    },
    {
        id: 'tutorials',
        title: 'Tutorial Help',
        description: 'Questions about tutorials and learning paths',
        icon: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
        color: 'from-purple-500 to-purple-600',
        articles: 18
    },
    {
        id: 'certification',
        title: 'Certifications',
        description: 'Azure certification exam preparation and resources',
        icon: 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
        color: 'from-yellow-500 to-yellow-600',
        articles: 15
    },
    {
        id: 'labs',
        title: 'Hands-on Labs',
        description: 'Issues with lab environments and exercises',
        icon: 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
        color: 'from-red-500 to-red-600',
        articles: 10
    },
    {
        id: 'feedback',
        title: 'Feedback & Suggestions',
        description: 'Share your ideas and help us improve',
        icon: 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z',
        color: 'from-pink-500 to-pink-600',
        articles: 8
    }
];
</script>

<template>
    <div>
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-navy-900 mb-3">Browse by Category</h2>
            <p class="text-lg text-navy-600">Choose a category to find relevant help articles</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <button
                v-for="category in categories"
                :key="category.id"
                @click="$emit('category-select', category.id)"
                class="group bg-white rounded-2xl border-2 border-gray-200 p-6 text-left hover:border-primary-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
            >
                <!-- Icon -->
                <div 
                    class="w-14 h-14 rounded-xl bg-gradient-to-br flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg"
                    :class="category.color"
                >
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" :d="category.icon"/>
                    </svg>
                </div>

                <!-- Content -->
                <h3 class="text-xl font-bold text-navy-900 group-hover:text-primary-600 transition-colors mb-2">
                    {{ category.title }}
                </h3>
                <p class="text-sm text-navy-600 mb-4">
                    {{ category.description }}
                </p>

                <!-- Article Count -->
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-primary-600">
                        {{ category.articles }} articles
                    </span>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </button>
        </div>
    </div>
</template>
