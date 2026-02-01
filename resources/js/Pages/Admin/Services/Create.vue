<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import IconPicker from '@/Components/Admin/IconPicker.vue';
import Sidebar from '../Global/Sidebar.vue';
import Topbar from '../Global/Topbar.vue';

const props = defineProps({
    categories: Array,
});

// Form state
const form = ref({
    service_category_id: '',
    name: '',
    slug: '',
    description: '',
    icon_identifier: '',
    video_url: '',
    video_thumbnail: '',
    video_duration: '',
    difficulty: 'beginner',
    order: 0,
    is_active: true,
    tutorial_sections: [],
});

const errors = ref({});
const processing = ref(false);

const videoPreview = ref(null);
const thumbnailPreview = ref(null);
const videoFile = ref(null);
const thumbnailFile = ref(null);

// Handle video file selection
const handleVideoFile = (event) => {
    const file = event.target.files[0];
    if (file) {
        videoFile.value = file;
        videoPreview.value = URL.createObjectURL(file);
    }
};

// Handle thumbnail file selection
const handleThumbnailFile = (event) => {
    const file = event.target.files[0];
    if (file) {
        thumbnailFile.value = file;
        thumbnailPreview.value = URL.createObjectURL(file);
    }
};

// Add new section
const addSection = () => {
    form.value.tutorial_sections.push({
        title: '',
        slug: '',
        order: form.value.tutorial_sections.length,
        is_active: true,
        content_blocks: [],
    });
};

// Remove section
const removeSection = (index) => {
    form.value.tutorial_sections.splice(index, 1);
    form.value.tutorial_sections.forEach((section, idx) => {
        section.order = idx;
    });
};

// Move section up
const moveSectionUp = (index) => {
    if (index > 0) {
        const temp = form.value.tutorial_sections[index];
        form.value.tutorial_sections[index] = form.value.tutorial_sections[index - 1];
        form.value.tutorial_sections[index - 1] = temp;
        form.value.tutorial_sections.forEach((section, idx) => {
            section.order = idx;
        });
    }
};

// Move section down
const moveSectionDown = (index) => {
    if (index < form.value.tutorial_sections.length - 1) {
        const temp = form.value.tutorial_sections[index];
        form.value.tutorial_sections[index] = form.value.tutorial_sections[index + 1];
        form.value.tutorial_sections[index + 1] = temp;
        form.value.tutorial_sections.forEach((section, idx) => {
            section.order = idx;
        });
    }
};

// Add content block to section
const addContentBlock = (sectionIndex, type = 'content') => {
    const section = form.value.tutorial_sections[sectionIndex];
    section.content_blocks.push({
        type: type,
        content: '',
        code_language: type === 'code' ? 'bash' : null,
        order: section.content_blocks.length,
        is_active: true,
    });
};

// Remove content block
const removeContentBlock = (sectionIndex, blockIndex) => {
    form.value.tutorial_sections[sectionIndex].content_blocks.splice(blockIndex, 1);
    form.value.tutorial_sections[sectionIndex].content_blocks.forEach((block, idx) => {
        block.order = idx;
    });
};

// Move block up
const moveBlockUp = (sectionIndex, blockIndex) => {
    const blocks = form.value.tutorial_sections[sectionIndex].content_blocks;
    if (blockIndex > 0) {
        const temp = blocks[blockIndex];
        blocks[blockIndex] = blocks[blockIndex - 1];
        blocks[blockIndex - 1] = temp;
        blocks.forEach((block, idx) => {
            block.order = idx;
        });
    }
};

// Move block down
const moveBlockDown = (sectionIndex, blockIndex) => {
    const blocks = form.value.tutorial_sections[sectionIndex].content_blocks;
    if (blockIndex < blocks.length - 1) {
        const temp = blocks[blockIndex];
        blocks[blockIndex] = blocks[blockIndex + 1];
        blocks[blockIndex + 1] = temp;
        blocks.forEach((block, idx) => {
            block.order = idx;
        });
    }
};

// Auto-generate slug from name
const generateSlug = () => {
    if (form.value.name) {
        form.value.slug = form.value.name
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
    }
};

// Auto-generate section slug from title
const generateSectionSlug = (section) => {
    if (section.title) {
        section.slug = section.title
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
    }
};

// Expanded sections tracking
const expandedSections = ref(new Set());

const toggleSection = (index) => {
    if (expandedSections.value.has(index)) {
        expandedSections.value.delete(index);
    } else {
        expandedSections.value.add(index);
    }
};

const submit = () => {
    processing.value = true;
    errors.value = {};

    // Build FormData for file uploads
    const formData = new FormData();

    // Add basic fields
    formData.append('service_category_id', form.value.service_category_id);
    formData.append('name', form.value.name);
    formData.append('slug', form.value.slug || '');
    formData.append('description', form.value.description);
    formData.append('icon_identifier', form.value.icon_identifier || '');
    formData.append('video_url', form.value.video_url || '');
    formData.append('video_thumbnail', form.value.video_thumbnail || '');
    formData.append('video_duration', form.value.video_duration || '');
    formData.append('difficulty', form.value.difficulty);
    formData.append('order', form.value.order);
    formData.append('is_active', form.value.is_active ? '1' : '0');

    // Add files if present
    if (videoFile.value) {
        formData.append('video_file', videoFile.value);
    }
    if (thumbnailFile.value) {
        formData.append('video_thumbnail_file', thumbnailFile.value);
    }

    // Add tutorial sections
    form.value.tutorial_sections.forEach((section, sIndex) => {
        formData.append(`tutorial_sections[${sIndex}][title]`, section.title);
        formData.append(`tutorial_sections[${sIndex}][slug]`, section.slug || '');
        formData.append(`tutorial_sections[${sIndex}][order]`, section.order);
        formData.append(`tutorial_sections[${sIndex}][is_active]`, section.is_active ? '1' : '0');

        section.content_blocks.forEach((block, bIndex) => {
            formData.append(`tutorial_sections[${sIndex}][content_blocks][${bIndex}][type]`, block.type);
            formData.append(`tutorial_sections[${sIndex}][content_blocks][${bIndex}][content]`, block.content || '');
            formData.append(`tutorial_sections[${sIndex}][content_blocks][${bIndex}][code_language]`, block.code_language || '');
            formData.append(`tutorial_sections[${sIndex}][content_blocks][${bIndex}][order]`, block.order);
        });
    });

    router.post(route('admin.services.store'), formData, {
        forceFormData: true,
        onSuccess: () => {
            processing.value = false;
        },
        onError: (err) => {
            errors.value = err;
            processing.value = false;
        },
        onFinish: () => {
            processing.value = false;
        }
    });
};

// Get block type config
const getBlockTypeConfig = (type) => {
    const configs = {
        content: { bg: 'bg-white', border: 'border-gray-200', icon: 'M4 6h16M4 12h16M4 18h7', label: 'Content' },
        code: { bg: 'bg-slate-900', border: 'border-slate-700', icon: 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', label: 'Code', textColor: 'text-white' },
        tip: { bg: 'bg-emerald-50', border: 'border-emerald-200', icon: 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', label: 'Tip' },
        warning: { bg: 'bg-amber-50', border: 'border-amber-200', icon: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z', label: 'Warning' },
        info: { bg: 'bg-blue-50', border: 'border-blue-200', icon: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', label: 'Info' },
    };
    return configs[type] || configs.content;
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
        <Sidebar />
        <Topbar title="Create Service" subtitle="Add a new Azure service with tutorial content" />

        <main class="ml-64 pt-16">
            <div class="p-6">
                <div class="max-w-6xl mx-auto">
                    <!-- Header Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="h-14 w-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/25">
                                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">Create New Service</h1>
                                    <p class="text-sm text-gray-500 mt-0.5">Add a new Azure service with tutorial content</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <a
                                    :href="route('admin.services.index')"
                                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200"
                                >
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Cancel
                                </a>
                                <button
                                    @click="submit"
                                    :disabled="processing"
                                    class="inline-flex items-center px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl hover:from-emerald-700 hover:to-teal-700 shadow-lg shadow-emerald-500/25 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <svg v-if="processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <svg v-else class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ processing ? 'Creating...' : 'Create Service' }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Basic Information -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Category -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Category <span class="text-red-500">*</span>
                                        </label>
                                        <select
                                            v-model="form.service_category_id"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                            required
                                        >
                                            <option value="">Select a category</option>
                                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                                {{ category.name }}
                                            </option>
                                        </select>
                                        <p v-if="errors.service_category_id" class="text-red-500 text-sm flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ errors.service_category_id }}
                                        </p>
                                    </div>

                                    <!-- Name -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Service Name <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                            v-model="form.name"
                                            @blur="generateSlug"
                                            type="text"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                            placeholder="e.g., Virtual Machines"
                                            required
                                        />
                                        <p v-if="errors.name" class="text-red-500 text-sm flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ errors.name }}
                                        </p>
                                    </div>

                                    <!-- Slug -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Slug <span class="text-gray-400 text-xs font-normal">(Auto-generated)</span>
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">/tutorials/</span>
                                            <input
                                                v-model="form.slug"
                                                type="text"
                                                class="w-full pl-24 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                                placeholder="virtual-machines"
                                            />
                                        </div>
                                    </div>

                                    <!-- Difficulty -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Difficulty <span class="text-red-500">*</span>
                                        </label>
                                        <div class="grid grid-cols-3 gap-3">
                                            <label
                                                :class="[
                                                    'relative flex items-center justify-center px-4 py-3 rounded-xl border-2 cursor-pointer transition-all duration-200',
                                                    form.difficulty === 'beginner'
                                                        ? 'border-emerald-500 bg-emerald-50 text-emerald-700'
                                                        : 'border-gray-200 hover:border-gray-300 bg-gray-50'
                                                ]"
                                            >
                                                <input type="radio" v-model="form.difficulty" value="beginner" class="sr-only" />
                                                <span class="text-sm font-medium">Beginner</span>
                                            </label>
                                            <label
                                                :class="[
                                                    'relative flex items-center justify-center px-4 py-3 rounded-xl border-2 cursor-pointer transition-all duration-200',
                                                    form.difficulty === 'intermediate'
                                                        ? 'border-amber-500 bg-amber-50 text-amber-700'
                                                        : 'border-gray-200 hover:border-gray-300 bg-gray-50'
                                                ]"
                                            >
                                                <input type="radio" v-model="form.difficulty" value="intermediate" class="sr-only" />
                                                <span class="text-sm font-medium">Intermediate</span>
                                            </label>
                                            <label
                                                :class="[
                                                    'relative flex items-center justify-center px-4 py-3 rounded-xl border-2 cursor-pointer transition-all duration-200',
                                                    form.difficulty === 'advanced'
                                                        ? 'border-red-500 bg-red-50 text-red-700'
                                                        : 'border-gray-200 hover:border-gray-300 bg-gray-50'
                                                ]"
                                            >
                                                <input type="radio" v-model="form.difficulty" value="advanced" class="sr-only" />
                                                <span class="text-sm font-medium">Advanced</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Order -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Display Order</label>
                                        <input
                                            v-model.number="form.order"
                                            type="number"
                                            min="0"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                        />
                                    </div>

                                    <!-- Active Status -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Status</label>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input
                                                v-model="form.is_active"
                                                type="checkbox"
                                                class="sr-only peer"
                                            />
                                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600"></div>
                                            <span class="ml-3 text-sm font-medium" :class="form.is_active ? 'text-blue-600' : 'text-gray-500'">
                                                {{ form.is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mt-6 space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Description <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        v-model="form.description"
                                        rows="4"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white resize-none"
                                        placeholder="Brief description of the service..."
                                        required
                                    ></textarea>
                                    <p v-if="errors.description" class="text-red-500 text-sm flex items-center gap-1">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ errors.description }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Icon Selection -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-semibold text-gray-900">Icon Selection</h2>
                                </div>
                            </div>
                            <div class="p-6">
                                <IconPicker v-model="form.icon_identifier" />
                            </div>
                        </div>

                        <!-- Video Upload -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-rose-100 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-semibold text-gray-900">Video Content</h2>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Video File -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Upload Video</label>
                                        <div class="relative">
                                            <input
                                                type="file"
                                                @change="handleVideoFile"
                                                accept="video/*"
                                                class="hidden"
                                                id="video-upload"
                                            />
                                            <label
                                                for="video-upload"
                                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50/50 transition-all duration-200"
                                            >
                                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <span class="mt-2 text-sm text-gray-500">Click to upload video</span>
                                            </label>
                                        </div>
                                        <div v-if="videoPreview" class="mt-3">
                                            <video :src="videoPreview" controls class="w-full max-h-48 rounded-xl"></video>
                                        </div>
                                    </div>

                                    <!-- Thumbnail -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Video Thumbnail</label>
                                        <div class="relative">
                                            <input
                                                type="file"
                                                @change="handleThumbnailFile"
                                                accept="image/*"
                                                class="hidden"
                                                id="thumbnail-upload"
                                            />
                                            <label
                                                for="thumbnail-upload"
                                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50/50 transition-all duration-200"
                                            >
                                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="mt-2 text-sm text-gray-500">Click to upload thumbnail</span>
                                            </label>
                                        </div>
                                        <div v-if="thumbnailPreview" class="mt-3">
                                            <img :src="thumbnailPreview" alt="Thumbnail" class="w-full max-h-48 object-cover rounded-xl" />
                                        </div>
                                    </div>

                                    <!-- Video Duration -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Video Duration</label>
                                        <input
                                            v-model="form.video_duration"
                                            type="text"
                                            placeholder="e.g., 18:45"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                        />
                                    </div>

                                    <!-- Video URL -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            External Video URL <span class="text-gray-400 text-xs font-normal">(YouTube, Vimeo)</span>
                                        </label>
                                        <input
                                            v-model="form.video_url"
                                            type="url"
                                            placeholder="https://..."
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tutorial Sections -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-lg bg-indigo-100 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-900">Tutorial Sections</h2>
                                            <p class="text-xs text-gray-500">{{ form.tutorial_sections.length }} section(s)</p>
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        @click="addSection"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg shadow-indigo-500/25 transition-all duration-200"
                                    >
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add Section
                                    </button>
                                </div>
                            </div>

                            <div class="p-6">
                                <div v-if="form.tutorial_sections.length === 0" class="text-center py-12">
                                    <div class="h-16 w-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">No sections yet</h3>
                                    <p class="text-gray-500 text-sm">Click "Add Section" to create tutorial content</p>
                                </div>

                                <!-- Sections List -->
                                <div v-else class="space-y-4">
                                    <div
                                        v-for="(section, sectionIndex) in form.tutorial_sections"
                                        :key="sectionIndex"
                                        class="border border-gray-200 rounded-xl overflow-hidden bg-gray-50/50"
                                    >
                                        <!-- Section Header -->
                                        <div
                                            class="flex items-center justify-between px-4 py-3 bg-white border-b border-gray-100 cursor-pointer"
                                            @click="toggleSection(sectionIndex)"
                                        >
                                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                                <div class="flex items-center gap-1">
                                                    <span class="flex items-center justify-center h-7 w-7 rounded-lg bg-indigo-100 text-indigo-600 text-sm font-semibold">
                                                        {{ sectionIndex + 1 }}
                                                    </span>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <input
                                                        v-model="section.title"
                                                        @blur="generateSectionSlug(section)"
                                                        @click.stop
                                                        type="text"
                                                        placeholder="Section Title"
                                                        class="w-full px-3 py-2 text-base font-medium border border-transparent rounded-lg hover:border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition-all bg-transparent"
                                                    />
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2 ml-4" @click.stop>
                                                <button
                                                    type="button"
                                                    @click="moveSectionUp(sectionIndex)"
                                                    :disabled="sectionIndex === 0"
                                                    class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg disabled:opacity-30 disabled:cursor-not-allowed transition-all"
                                                    title="Move Up"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                    </svg>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="moveSectionDown(sectionIndex)"
                                                    :disabled="sectionIndex === form.tutorial_sections.length - 1"
                                                    class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg disabled:opacity-30 disabled:cursor-not-allowed transition-all"
                                                    title="Move Down"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="removeSection(sectionIndex)"
                                                    class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all"
                                                    title="Delete Section"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                                <svg
                                                    class="h-5 w-5 text-gray-400 transition-transform duration-200"
                                                    :class="{ 'rotate-180': expandedSections.has(sectionIndex) }"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Section Content (Collapsible) -->
                                        <div v-show="expandedSections.has(sectionIndex)" class="p-4 space-y-4">
                                            <!-- Section Slug -->
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm text-gray-500">Slug:</span>
                                                <input
                                                    v-model="section.slug"
                                                    type="text"
                                                    placeholder="section-slug"
                                                    class="flex-1 px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                />
                                            </div>

                                            <!-- Add Content Block Buttons -->
                                            <div class="flex flex-wrap gap-2">
                                                <button
                                                    type="button"
                                                    @click="addContentBlock(sectionIndex, 'content')"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg border border-gray-200 bg-white hover:bg-gray-50 transition-all"
                                                >
                                                    <svg class="h-3.5 w-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                                    </svg>
                                                    Content
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="addContentBlock(sectionIndex, 'code')"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg border border-slate-300 bg-slate-800 text-white hover:bg-slate-700 transition-all"
                                                >
                                                    <svg class="h-3.5 w-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                                    </svg>
                                                    Code
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="addContentBlock(sectionIndex, 'tip')"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-all"
                                                >
                                                    <svg class="h-3.5 w-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                                    </svg>
                                                    Tip
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="addContentBlock(sectionIndex, 'warning')"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg border border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100 transition-all"
                                                >
                                                    <svg class="h-3.5 w-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                    Warning
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="addContentBlock(sectionIndex, 'info')"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg border border-blue-200 bg-blue-50 text-blue-700 hover:bg-blue-100 transition-all"
                                                >
                                                    <svg class="h-3.5 w-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Info
                                                </button>
                                            </div>

                                            <!-- Content Blocks -->
                                            <div v-if="section.content_blocks.length > 0" class="space-y-3">
                                                <div
                                                    v-for="(block, blockIndex) in section.content_blocks"
                                                    :key="blockIndex"
                                                    :class="[
                                                        'rounded-xl border overflow-hidden',
                                                        getBlockTypeConfig(block.type).bg,
                                                        getBlockTypeConfig(block.type).border
                                                    ]"
                                                >
                                                    <div
                                                        :class="[
                                                            'flex items-center justify-between px-4 py-2 border-b',
                                                            getBlockTypeConfig(block.type).border,
                                                            block.type === 'code' ? 'bg-slate-800' : 'bg-white/50'
                                                        ]"
                                                    >
                                                        <div class="flex items-center gap-2">
                                                            <svg
                                                                :class="[
                                                                    'h-4 w-4',
                                                                    block.type === 'code' ? 'text-emerald-400' :
                                                                    block.type === 'tip' ? 'text-emerald-600' :
                                                                    block.type === 'warning' ? 'text-amber-600' :
                                                                    block.type === 'info' ? 'text-blue-600' : 'text-gray-600'
                                                                ]"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="getBlockTypeConfig(block.type).icon" />
                                                            </svg>
                                                            <span
                                                                :class="[
                                                                    'text-sm font-medium capitalize',
                                                                    block.type === 'code' ? 'text-white' : 'text-gray-700'
                                                                ]"
                                                            >
                                                                {{ getBlockTypeConfig(block.type).label }}
                                                            </span>
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <button
                                                                type="button"
                                                                @click="moveBlockUp(sectionIndex, blockIndex)"
                                                                :disabled="blockIndex === 0"
                                                                :class="[
                                                                    'p-1.5 rounded transition-all disabled:opacity-30',
                                                                    block.type === 'code' ? 'text-gray-400 hover:text-white hover:bg-slate-700' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-100'
                                                                ]"
                                                            >
                                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                type="button"
                                                                @click="moveBlockDown(sectionIndex, blockIndex)"
                                                                :disabled="blockIndex === section.content_blocks.length - 1"
                                                                :class="[
                                                                    'p-1.5 rounded transition-all disabled:opacity-30',
                                                                    block.type === 'code' ? 'text-gray-400 hover:text-white hover:bg-slate-700' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-100'
                                                                ]"
                                                            >
                                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                type="button"
                                                                @click="removeContentBlock(sectionIndex, blockIndex)"
                                                                :class="[
                                                                    'p-1.5 rounded transition-all',
                                                                    block.type === 'code' ? 'text-red-400 hover:text-red-300 hover:bg-red-900/30' : 'text-red-400 hover:text-red-600 hover:bg-red-50'
                                                                ]"
                                                            >
                                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="p-4">
                                                        <!-- Code Block -->
                                                        <div v-if="block.type === 'code'" class="space-y-3">
                                                            <select
                                                                v-model="block.code_language"
                                                                class="w-full px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white text-sm focus:ring-2 focus:ring-blue-500"
                                                            >
                                                                <option value="bash">Bash</option>
                                                                <option value="powershell">PowerShell</option>
                                                                <option value="javascript">JavaScript</option>
                                                                <option value="python">Python</option>
                                                                <option value="json">JSON</option>
                                                                <option value="yaml">YAML</option>
                                                                <option value="csharp">C#</option>
                                                            </select>
                                                            <textarea
                                                                v-model="block.content"
                                                                rows="8"
                                                                class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-lg text-emerald-400 font-mono text-sm focus:ring-2 focus:ring-blue-500 resize-none"
                                                                placeholder="Enter code here..."
                                                            ></textarea>
                                                        </div>

                                                        <!-- Rich Text Editor for Content -->
                                                        <div v-else-if="block.type === 'content'">
                                                            <QuillEditor
                                                                v-model:content="block.content"
                                                                theme="snow"
                                                                :toolbar="['bold', 'italic', 'underline', 'link', { 'list': 'ordered' }, { 'list': 'bullet' }]"
                                                                content-type="html"
                                                                placeholder="Write your content here..."
                                                                class="bg-white rounded-lg"
                                                            />
                                                        </div>

                                                        <!-- Simple Textarea for Tips/Warnings/Info -->
                                                        <div v-else>
                                                            <textarea
                                                                v-model="block.content"
                                                                rows="4"
                                                                class="w-full px-4 py-3 bg-white/80 border border-current/20 rounded-lg focus:ring-2 focus:ring-blue-500 resize-none"
                                                                :placeholder="`Enter ${block.type} text...`"
                                                            ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div v-else class="text-center py-6 text-gray-400 text-sm bg-white/50 rounded-lg border border-dashed border-gray-200">
                                                No content blocks yet. Click a button above to add content.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Action Bar -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky bottom-4">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    <span class="font-medium text-gray-700">{{ form.tutorial_sections.length }}</span> section(s) •
                                    <span class="font-medium text-gray-700">{{ form.tutorial_sections.reduce((acc, s) => acc + s.content_blocks.length, 0) }}</span> content block(s)
                                </div>
                                <div class="flex items-center gap-3">
                                    <a
                                        :href="route('admin.services.index')"
                                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-all"
                                    >
                                        Cancel
                                    </a>
                                    <button
                                        type="submit"
                                        :disabled="processing"
                                        class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-emerald-600 to-teal-600 rounded-xl hover:from-emerald-700 hover:to-teal-700 shadow-lg shadow-emerald-500/25 transition-all disabled:opacity-50"
                                    >
                                        {{ processing ? 'Creating...' : 'Create Service' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
:deep(.ql-editor) {
    min-height: 150px;
}
:deep(.ql-container) {
    border-bottom-left-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}
:deep(.ql-toolbar) {
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}
</style>
