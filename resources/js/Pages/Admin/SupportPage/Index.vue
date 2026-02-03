<script setup>
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import Sidebar from '../Global/Sidebar.vue';
import Topbar from '../Global/Topbar.vue';

const props = defineProps({
    sections: Array,
    groupedSections: Object,
    sectionTypes: Array,
});

const showModal = ref(false);
const editingSection = ref(null);
const activeTab = ref('all');

const form = ref({
    section_type: '',
    title: '',
    subtitle: '',
    description: '',
    icon: '',
    link_url: '',
    link_text: '',
    color_scheme: '',
    data: {},
    sort_order: 0,
    is_active: true,
});

const openCreateModal = (type = '') => {
    editingSection.value = null;
    form.value = {
        section_type: type,
        title: '',
        subtitle: '',
        description: '',
        icon: '',
        link_url: '',
        link_text: '',
        color_scheme: '',
        data: {},
        sort_order: 0,
        is_active: true,
    };
    showModal.value = true;
};

const openEditModal = (section) => {
    editingSection.value = section;
    form.value = {
        section_type: section.section_type,
        title: section.title || '',
        subtitle: section.subtitle || '',
        description: section.description || '',
        icon: section.icon || '',
        link_url: section.link_url || '',
        link_text: section.link_text || '',
        color_scheme: section.color_scheme || '',
        data: section.data || {},
        sort_order: section.sort_order,
        is_active: section.is_active,
    };
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    editingSection.value = null;
};

const submitForm = () => {
    if (editingSection.value) {
        router.put(route('admin.support-page.update', editingSection.value.id), form.value, {
            onSuccess: () => closeModal(),
        });
    } else {
        router.post(route('admin.support-page.store'), form.value, {
            onSuccess: () => closeModal(),
        });
    }
};

const deleteSection = (section) => {
    if (confirm('Are you sure you want to delete this section?')) {
        router.delete(route('admin.support-page.destroy', section.id));
    }
};

const toggleActive = (section) => {
    router.put(route('admin.support-page.toggle-active', section.id));
};

const filteredSections = computed(() => {
    if (activeTab.value === 'all') {
        return props.sections;
    }
    return props.sections.filter(s => s.section_type === activeTab.value);
});

const getSectionTypeLabel = (type) => {
    const sectionType = props.sectionTypes.find(t => t.value === type);
    return sectionType ? sectionType.label : type;
};

const sectionTypeCounts = computed(() => {
    const counts = { all: props.sections.length };
    props.sectionTypes.forEach(type => {
        counts[type.value] = props.sections.filter(s => s.section_type === type.value).length;
    });
    return counts;
});
</script>

<template>
    <div class="flex h-screen bg-gray-100">
        <Head title="Support Page Management - Admin" />
        
        <Sidebar />
        
        <div class="flex-1 flex flex-col overflow-hidden ml-64">
            <Topbar />
            
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Header -->
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Support Page Management</h1>
                            <p class="text-gray-600 mt-1">Manage all sections of the support page</p>
                        </div>
                        <button
                            @click="openCreateModal()"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add New Section
                        </button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="flex -mb-px">
                            <button
                                @click="activeTab = 'all'"
                                :class="[
                                    'px-6 py-3 text-sm font-medium border-b-2 transition-colors',
                                    activeTab === 'all'
                                        ? 'border-blue-500 text-blue-600'
                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                                ]"
                            >
                                All Sections
                                <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-gray-100">{{ sectionTypeCounts.all }}</span>
                            </button>
                            <button
                                v-for="type in sectionTypes"
                                :key="type.value"
                                @click="activeTab = type.value"
                                :class="[
                                    'px-6 py-3 text-sm font-medium border-b-2 transition-colors',
                                    activeTab === type.value
                                        ? 'border-blue-500 text-blue-600'
                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                                ]"
                            >
                                {{ type.label }}
                                <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-gray-100">{{ sectionTypeCounts[type.value] || 0 }}</span>
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Sections Grid -->
                <div class="grid gap-4">
                    <div
                        v-for="section in filteredSections"
                        :key="section.id"
                        class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow"
                    >
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                        {{ getSectionTypeLabel(section.section_type) }}
                                    </span>
                                    <span
                                        :class="[
                                            'px-3 py-1 text-xs font-semibold rounded-full',
                                            section.is_active
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-gray-100 text-gray-700'
                                        ]"
                                    >
                                        {{ section.is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <span class="text-xs text-gray-500">Order: {{ section.sort_order }}</span>
                                </div>
                                
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                    {{ section.title || 'Untitled' }}
                                </h3>
                                
                                <p v-if="section.subtitle" class="text-sm text-gray-600 mb-2">
                                    {{ section.subtitle }}
                                </p>
                                
                                <p v-if="section.description" class="text-sm text-gray-500">
                                    {{ section.description }}
                                </p>

                                <div v-if="section.link_url" class="mt-2 flex items-center gap-2 text-sm text-blue-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                    {{ section.link_url }}
                                </div>

                                <div v-if="section.icon" class="mt-2 text-xs text-gray-400">
                                    Icon: {{ section.icon.substring(0, 50) }}...
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2 ml-4">
                                <button
                                    @click="toggleActive(section)"
                                    :title="section.is_active ? 'Deactivate' : 'Activate'"
                                    class="p-2 text-gray-400 hover:text-blue-600 transition-colors"
                                >
                                    <svg v-if="section.is_active" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                                <button
                                    @click="openEditModal(section)"
                                    class="p-2 text-gray-400 hover:text-green-600 transition-colors"
                                    title="Edit"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button
                                    @click="deleteSection(section)"
                                    class="p-2 text-gray-400 hover:text-red-600 transition-colors"
                                    title="Delete"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div v-if="filteredSections.length === 0" class="bg-white rounded-lg shadow p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No sections found</h3>
                        <p class="text-gray-500 mb-4">Get started by creating your first section.</p>
                        <button
                            @click="openCreateModal(activeTab !== 'all' ? activeTab : '')"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Create Section
                        </button>
                    </div>
                </div>
            </main>
        </div>

        <!-- Modal -->
        <Teleport to="body">
            <transition
                enter-active-class="transition-opacity duration-200"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-opacity duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
                    <transition
                        enter-active-class="transition-all duration-200"
                        enter-from-class="opacity-0 scale-95"
                        enter-to-class="opacity-100 scale-100"
                        leave-active-class="transition-all duration-200"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div v-if="showModal" class="bg-white rounded-lg shadow-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                                <h2 class="text-xl font-bold text-gray-900">
                                    {{ editingSection ? 'Edit Section' : 'Create New Section' }}
                                </h2>
                                <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>

                            <form @submit.prevent="submitForm" class="p-6 space-y-4">
                                <!-- Section Type -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Section Type *</label>
                                    <select
                                        v-model="form.section_type"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                        <option value="">Select a type</option>
                                        <option v-for="type in sectionTypes" :key="type.value" :value="type.value">
                                            {{ type.label }} - {{ type.description }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Title -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                    <input
                                        v-model="form.title"
                                        type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Subtitle -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                                    <input
                                        v-model="form.subtitle"
                                        type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea
                                        v-model="form.description"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    ></textarea>
                                </div>

                                <!-- Icon SVG Path -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Icon SVG Path</label>
                                    <textarea
                                        v-model="form.icon"
                                        rows="2"
                                        placeholder="SVG path data (d attribute)"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono text-xs"
                                    ></textarea>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Link URL -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Link URL</label>
                                        <input
                                            v-model="form.link_url"
                                            type="text"
                                            placeholder="/tutorials"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Link Text -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Text</label>
                                        <input
                                            v-model="form.link_text"
                                            type="text"
                                            placeholder="Learn More"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        />
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Color Scheme -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Color Scheme</label>
                                        <input
                                            v-model="form.color_scheme"
                                            type="text"
                                            placeholder="from-blue-500 to-blue-600"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Sort Order -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                                        <input
                                            v-model.number="form.sort_order"
                                            type="number"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        />
                                    </div>
                                </div>

                                <!-- Active Status -->
                                <div class="flex items-center">
                                    <input
                                        v-model="form.is_active"
                                        type="checkbox"
                                        id="is_active"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    />
                                    <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">Active</label>
                                </div>

                                <!-- Actions -->
                                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                                    <button
                                        type="button"
                                        @click="closeModal"
                                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        {{ editingSection ? 'Update' : 'Create' }} Section
                                    </button>
                                </div>
                            </form>
                        </div>
                    </transition>
                </div>
            </transition>
        </Teleport>
    </div>
</template>
