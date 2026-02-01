<template>
    <div>
        <!-- Selected Icon Display Button -->
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Service Icon *</label>
            <button
                type="button"
                @click="openPicker"
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-blue-500 transition-colors flex items-center justify-between bg-white"
            >
                <div class="flex items-center space-x-3">
                    <div v-if="selectedIcon" class="w-12 h-12 flex items-center justify-center" v-html="selectedIcon.svg"></div>
                    <div v-else class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-medium text-gray-900">
                            {{ selectedIcon ? selectedIcon.name : 'Select an icon' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ selectedIcon ? selectedIcon.category : 'Click to choose' }}
                        </p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <!-- Icon Picker Modal -->
        <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" @click.self="closePicker">
            <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[80vh] overflow-hidden">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Select Service Icon</h3>
                            <p class="text-sm text-gray-500 mt-1">Choose an Azure service icon from the library</p>
                        </div>
                        <button @click="closePicker" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Search -->
                    <div class="mt-4">
                        <div class="relative">
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Search icons..."
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Icons Grid -->
                <div class="p-6 overflow-y-auto max-h-[calc(80vh-200px)]">
                    <div v-for="(icons, category) in filteredIcons" :key="category" class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wider">{{ category }}</h4>
                        <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3">
                            <button
                                v-for="icon in icons"
                                :key="icon.id"
                                type="button"
                                @click="selectIcon(icon.id)"
                                :class="[
                                    'flex flex-col items-center p-3 rounded-lg border-2 transition-all hover:scale-105',
                                    modelValue === icon.id
                                        ? 'border-blue-500 bg-blue-50 shadow-md'
                                        : 'border-gray-200 hover:border-blue-300'
                                ]"
                            >
                                <div class="w-12 h-12 flex items-center justify-center" v-html="icon.svg"></div>
                                <span class="text-xs text-gray-600 mt-2 text-center leading-tight">{{ icon.name }}</span>
                            </button>
                        </div>
                    </div>

                    <!-- No Results -->
                    <div v-if="Object.keys(filteredIcons).length === 0" class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <p class="text-gray-500">No icons found matching "{{ searchQuery }}"</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <p class="text-sm text-gray-600">
                            {{ Object.values(iconsByCategory).flat().length }} icons available
                        </p>
                        <button
                            @click="closePicker"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Done
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { useAzureIcons } from '@/Composables/useAzureIcons';

const props = defineProps({
    modelValue: String
});

const emit = defineEmits(['update:modelValue']);

const { getIcon, getIconsByCategory } = useAzureIcons();

const isOpen = ref(false);
const searchQuery = ref('');
const iconsByCategory = getIconsByCategory();

const selectedIcon = computed(() => {
    return props.modelValue ? getIcon(props.modelValue) : null;
});

const filteredIcons = computed(() => {
    if (!searchQuery.value) {
        return iconsByCategory;
    }

    const query = searchQuery.value.toLowerCase();
    const filtered = {};

    Object.entries(iconsByCategory).forEach(([category, icons]) => {
        const matchedIcons = icons.filter(icon =>
            icon.name.toLowerCase().includes(query) ||
            icon.id.toLowerCase().includes(query) ||
            category.toLowerCase().includes(query)
        );

        if (matchedIcons.length > 0) {
            filtered[category] = matchedIcons;
        }
    });

    return filtered;
});

const openPicker = () => {
    isOpen.value = true;
    searchQuery.value = '';
};

const closePicker = () => {
    isOpen.value = false;
};

const selectIcon = (iconId) => {
    emit('update:modelValue', iconId);
    closePicker();
};
</script>
