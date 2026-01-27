<script setup>
import { ref } from 'vue';

const form = ref({
    name: '',
    email: '',
    category: 'technical',
    priority: 'medium',
    subject: '',
    message: ''
});

const submitForm = () => {
    // Handle form submission
    console.log('Form submitted:', form.value);
    alert('Thank you for contacting us! We will get back to you within 24 hours.');
    // Reset form
    form.value = {
        name: '',
        email: '',
        category: 'technical',
        priority: 'medium',
        subject: '',
        message: ''
    };
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

                    <!-- Priority -->
                    <div>
                        <label class="block text-sm font-semibold text-navy-900 mb-2">
                            Priority <span class="text-red-500">*</span>
                        </label>
                        <select 
                            v-model="form.priority"
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all"
                        >
                            <option value="low">Low - General inquiry</option>
                            <option value="medium">Medium - Need assistance</option>
                            <option value="high">High - Urgent issue</option>
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
                        class="px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105"
                    >
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
