<template>
    <div class="min-h-screen bg-gray-50">
        <Sidebar />
        <Topbar title="Certifications Management" subtitle="Manage Azure certifications" />

        <main class="ml-64 pt-16">
            <div class="p-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Certifications</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ stats.total }}</p>
                                </div>
                                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Active</p>
                                    <p class="text-2xl font-bold text-green-600 mt-1">{{ stats.active }}</p>
                                </div>
                                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Inactive</p>
                                    <p class="text-2xl font-bold text-gray-600 mt-1">{{ stats.inactive }}</p>
                                </div>
                                <div class="h-12 w-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters and Add Button -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                    <input
                                        v-model="filterForm.search"
                                        type="text"
                                        placeholder="Search by code or name..."
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        @input="debounceFilter"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <select
                                        v-model="filterForm.category_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        @change="applyFilters"
                                    >
                                        <option value="">All Categories</option>
                                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select
                                        v-model="filterForm.status"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        @change="applyFilters"
                                    >
                                        <option value="">All Statuses</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button
                                    @click="clearFilters"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition duration-200"
                                >
                                    Clear Filters
                                </button>
                                <a
                                    :href="route('admin.certifications.create')"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition duration-200"
                                >
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Certification
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Certifications Table -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Certification</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Details</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="cert in certifications.data" :key="cert.id" class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 flex items-center justify-center mr-3 rounded-lg font-bold text-white text-sm"
                                                    :class="getLevelColorClass(cert.level_color)"
                                                >
                                                    {{ cert.code.split('-')[0] }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">{{ cert.code }}</div>
                                                    <div class="text-sm text-gray-600">{{ cert.name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                {{ cert.category?.name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-xs text-gray-500 space-y-1">
                                                <div v-if="cert.exam_duration">Duration: {{ cert.exam_duration }}</div>
                                                <div v-if="cert.questions">Questions: {{ cert.questions }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                @click="toggleStatus(cert)"
                                                :class="[
                                                    'px-2 py-1 text-xs font-medium rounded-full cursor-pointer transition-colors',
                                                    cert.is_active
                                                        ? 'bg-green-100 text-green-800 hover:bg-green-200'
                                                        : 'bg-gray-100 text-gray-800 hover:bg-gray-200'
                                                ]"
                                            >
                                                {{ cert.is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a
                                                :href="route('admin.certifications.edit', cert.id)"
                                                class="text-blue-600 hover:text-blue-900 mr-3"
                                            >
                                                Edit
                                            </a>
                                            <button
                                                @click="deleteCertification(cert)"
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="certifications.data.length === 0">
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            No certifications found
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div v-if="certifications.links.length > 3" class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-700">
                                    Showing {{ certifications.from }} to {{ certifications.to }} of {{ certifications.total }} results
                                </div>
                                <div class="flex space-x-2">
                                    <component
                                        :is="link.url ? Link : 'span'"
                                        v-for="(link, index) in certifications.links"
                                        :key="index"
                                        :href="link.url || undefined"
                                        :class="[
                                            'px-3 py-2 text-sm rounded-lg transition duration-200',
                                            link.active
                                                ? 'bg-blue-600 text-white'
                                                : link.url
                                                    ? 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300'
                                                    : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                                        ]"
                                        v-html="link.label"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { reactive } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import Sidebar from '../Global/Sidebar.vue';
import Topbar from '../Global/Topbar.vue';

const props = defineProps({
    certifications: Object,
    categories: Array,
    stats: Object,
    filters: Object
});

const filterForm = reactive({
    search: props.filters.search || '',
    category_id: props.filters.category_id || '',
    status: props.filters.status || ''
});

let debounceTimeout = null;

const debounceFilter = () => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        applyFilters();
    }, 500);
};

const applyFilters = () => {
    router.get(route('admin.certifications.index'), filterForm, {
        preserveState: true,
        preserveScroll: true
    });
};

const clearFilters = () => {
    filterForm.search = '';
    filterForm.category_id = '';
    filterForm.status = '';
    applyFilters();
};

const toggleStatus = (cert) => {
    if (confirm(`Are you sure you want to ${cert.is_active ? 'deactivate' : 'activate'} "${cert.code}"?`)) {
        router.put(route('admin.certifications.toggle-status', cert.id), {}, {
            preserveScroll: true
        });
    }
};

const deleteCertification = (cert) => {
    if (confirm(`Are you sure you want to delete "${cert.code} - ${cert.name}"? This action cannot be undone.`)) {
        router.delete(route('admin.certifications.destroy', cert.id));
    }
};

const getLevelColorClass = (color) => {
    const colors = {
        green: 'bg-gradient-to-br from-green-500 to-emerald-500',
        blue: 'bg-gradient-to-br from-blue-500 to-cyan-500',
        purple: 'bg-gradient-to-br from-purple-500 to-pink-500',
        orange: 'bg-gradient-to-br from-orange-500 to-amber-500',
    };
    return colors[color] || colors.blue;
};
</script>
