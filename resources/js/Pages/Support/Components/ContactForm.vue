<script setup>
import { reactive, ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const page = usePage();
const processing = ref(false);
const successMessage = ref('');

const form = reactive({
    name: '',
    email: '',
    category: 'technical',
    subject: '',
    message: ''
});

const submitForm = () => {
    processing.value = true;
    successMessage.value = '';
    
    router.post(route('support.store'), form, {
        onSuccess: () => {
            // Reset form
            form.name = '';
            form.email = '';
            form.category = 'technical';
            form.subject = '';
            form.message = '';
            
            successMessage.value = 'Thank you for contacting us! We will get back to you within 24 hours.';
            
            // Hide success message after 5 seconds
            setTimeout(() => {
                successMessage.value = '';
            }, 5000);
        },
        onFinish: () => {
            processing.value = false;
        }
    });
};
</script>

<template>
    <div class="mt-16">
        <div class="bg-white rounded-3xl shadow-xl border-2 border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white mb-2">Contact Support</h2>
                <p class="text-primary-100">Fill out the form below and we'll get back to you as soon as possible</p>
            </div>

            <!-- Form Body -->
            <form @submit.prevent="submitForm" class="p-8">
                <!-- Success Message -->
                <div v-if="successMessage" class="mb-6 bg-green-50 border-2 border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-green-800 font-medium">{{ successMessage }}</p>
                    </div>
                </div>

                <!-- Error Messages -->
                <div v-if="$page.props.errors && Object.keys($page.props.errors).length > 0" class="mb-6 bg-red-50 border-2 border-red-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 text-red-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-red-800 font-medium mb-1">Please fix the following errors:</p>
                            <ul class="list-disc list-inside text-sm text-red-700">
                                <li v-for="(error, key) in $page.props.errors" :key="key">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-semibold text-navy-900 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            v-model="form.name"
                            type="text" 
                            required
                            placeholder="John Doe"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                        />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-navy-900 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input 
                            v-model="form.email"
                            type="email" 
                            required
                            placeholder="john@example.com"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                        />
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-semibold text-navy-900 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select 
                            v-model="form.category"
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                        >
                            <option value="technical">Technical Support</option>
                            <option value="account">Account & Billing</option>
                            <option value="tutorials">Tutorial Help</option>
                            <option value="certification">Certifications</option>
                            <option value="labs">Hands-on Labs</option>
                            <option value="feedback">Feedback & Suggestions</option>
                        </select>
                    </div>

                </div>

                <!-- Subject -->
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-navy-900 mb-2">
                        Subject <span class="text-red-500">*</span>
                    </label>
                    <input 
                        v-model="form.subject"
                        type="text" 
                        required
                        placeholder="Brief description of your issue"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                    />
                </div>

                <!-- Message -->
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-navy-900 mb-2">
                        Message <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        v-model="form.message"
                        required
                        rows="6"
                        placeholder="Please provide as much detail as possible..."
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none"
                    ></textarea>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        <span class="text-red-500">*</span> Required fields
                    </p>
                    <button 
                        type="submit"
                        :disabled="processing"
                        class="px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                    >
                        <span v-if="processing" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Submitting...
                        </span>
                        <span v-else>Submit Request</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
