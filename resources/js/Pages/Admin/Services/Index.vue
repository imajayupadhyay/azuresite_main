<template>
    <div class="min-h-screen bg-gray-50">
        <Sidebar />
        <Topbar title="Services Management" subtitle="Manage Azure services within categories" />

        <main class="ml-64 pt-16">
            <div class="p-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Services</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ stats.total }}</p>
                                </div>
                                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
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
                                        placeholder="Search services..."
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
                                <button
                                    @click="openAddModal"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition duration-200"
                                >
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Service
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Services Table -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Difficulty</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resources</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="service in services.data" :key="service.id" class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <!-- Display icon from identifier -->
                                                <div 
                                                    class="h-10 w-10 flex items-center justify-center mr-3 p-1" 
                                                    v-html="getIcon(service.icon_identifier || 'default').svg"
                                                ></div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ service.name }}</div>
                                                    <div class="text-xs text-gray-500">{{ service.slug }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                {{ service.category?.name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span :class="getDifficultyClass(service.difficulty)">
                                                {{ formatDifficulty(service.difficulty) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ service.tutorials_count }} tutorials
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                @click="toggleStatus(service)"
                                                :class="[
                                                    'px-2 py-1 text-xs font-medium rounded-full cursor-pointer transition-colors',
                                                    service.is_active
                                                        ? 'bg-green-100 text-green-800 hover:bg-green-200'
                                                        : 'bg-gray-100 text-gray-800 hover:bg-gray-200'
                                                ]"
                                            >
                                                {{ service.is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button
                                                @click="editService(service)"
                                                class="text-blue-600 hover:text-blue-900 mr-3"
                                            >
                                                Edit
                                            </button>
                                            <button
                                                @click="deleteService(service)"
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="services.data.length === 0">
                                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                            No services found
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div v-if="services.links.length > 3" class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-700">
                                    Showing {{ services.from }} to {{ services.to }} of {{ services.total }} results
                                </div>
                                <div class="flex space-x-2">
                                    <component
                                        :is="link.url ? Link : 'span'"
                                        v-for="(link, index) in services.links"
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

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-bold text-gray-900">
                            {{ editingService ? 'Edit Service' : 'Add New Service' }}
                        </h3>
                        <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <form @submit.prevent="saveService" class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Category -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select
                                v-model="form.service_category_id"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                                <option value="">Select category</option>
                                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                            </select>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Service Name *</label>
                            <input
                                v-model="form.name"
                                type="text"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="e.g., Virtual Machines"
                            />
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                            <input
                                v-model="form.slug"
                                type="text"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Auto-generated"
                            />
                        </div>

                        <!-- Difficulty -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Difficulty *</label>
                            <select
                                v-model="form.difficulty"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div>

                        <!-- Order -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Order *</label>
                            <input
                                v-model.number="form.order"
                                type="number"
                                required
                                min="0"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                            <textarea
                                v-model="form.description"
                                rows="3"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                placeholder="Brief description of the service..."
                            ></textarea>
                        </div>

                        <!-- Icon Picker -->
                        <div class="md:col-span-2">
                            <IconPicker v-model="form.icon_identifier" />
                        </div>

                        <!-- Video Duration -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Video Duration</label>
                            <input
                                v-model="form.video_duration"
                                type="text"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="e.g., 15:30"
                            />
                        </div>

                        <!-- Video URL -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Video URL</label>
                            <input
                                v-model="form.video_url"
                                type="url"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="https://..."
                            />
                        </div>

                        <!-- Video Thumbnail -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Video Thumbnail URL</label>
                            <input
                                v-model="form.video_thumbnail"
                                type="url"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="https://..."
                            />
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input
                                    v-model="form.is_active"
                                    type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                />
                                <span class="ml-2 text-sm font-medium text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <button
                            type="button"
                            @click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="processing"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition disabled:opacity-50"
                        >
                            {{ processing ? 'Saving...' : 'Save Service' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import Sidebar from '../Global/Sidebar.vue';
import Topbar from '../Global/Topbar.vue';
import IconPicker from '@/Components/Admin/IconPicker.vue';
import { useAzureIcons } from '@/Composables/useAzureIcons';

const { getIcon } = useAzureIcons();

const props = defineProps({
    services: Object,
    categories: Array,
    stats: Object,
    filters: Object
});

const filterForm = reactive({
    search: props.filters.search || '',
    category_id: props.filters.category_id || '',
    status: props.filters.status || ''
});

const showModal = ref(false);
const editingService = ref(null);
const processing = ref(false);

const form = reactive({
    service_category_id: '',
    name: '',
    slug: '',
    description: '',
    icon_identifier: 'default',
    video_url: '',
    video_thumbnail: '',
    video_duration: '',
    difficulty: 'beginner',
    order: 0,
    is_active: true
});

let debounceTimeout = null;

const debounceFilter = () => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        applyFilters();
    }, 500);
};

const applyFilters = () => {
    router.get(route('admin.services.index'), filterForm, {
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

const openAddModal = () => {
    editingService.value = null;
    form.service_category_id = '';
    form.name = '';
    form.slug = '';
    form.description = '';
    form.icon_identifier = 'default';
    form.video_url = '';
    form.video_thumbnail = '';
    form.video_duration = '';
    form.difficulty = 'beginner';
    form.order = props.services.data.length;
    form.is_active = true;
    showModal.value = true;
};

const editService = (service) => {
    editingService.value = service;
    form.service_category_id = service.service_category_id;
    form.name = service.name;
    form.slug = service.slug;
    form.description = service.description;
    form.icon_identifier = service.icon_identifier || 'default';
    form.video_url = service.video_url || '';
    form.video_thumbnail = service.video_thumbnail || '';
    form.video_duration = service.video_duration || '';
    form.difficulty = service.difficulty;
    form.order = service.order;
    form.is_active = service.is_active;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    editingService.value = null;
};

const saveService = () => {
    processing.value = true;

    if (editingService.value) {
        router.put(route('admin.services.update', editingService.value.id), form, {
            preserveScroll: true,
            onSuccess: () => {
                closeModal();
            },
            onFinish: () => {
                processing.value = false;
            }
        });
    } else {
        router.post(route('admin.services.store'), form, {
            preserveScroll: true,
            onSuccess: () => {
                closeModal();
            },
            onFinish: () => {
                processing.value = false;
            }
        });
    }
};

const toggleStatus = (service) => {
    if (confirm(`Are you sure you want to ${service.is_active ? 'deactivate' : 'activate'} "${service.name}"?`)) {
        router.put(route('admin.services.toggle-status', service.id), {}, {
            preserveScroll: true
        });
    }
};

const deleteService = (service) => {
    if (confirm(`Are you sure you want to delete "${service.name}"? This will also delete all related resources.`)) {
        router.delete(route('admin.services.destroy', service.id));
    }
};

const formatDifficulty = (difficulty) => {
    return difficulty.charAt(0).toUpperCase() + difficulty.slice(1);
};

const getDifficultyClass = (difficulty) => {
    const classes = {
        'beginner': 'px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800',
        'intermediate': 'px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800',
        'advanced': 'px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800'
    };
    return classes[difficulty] || classes['beginner'];
};
</script>
