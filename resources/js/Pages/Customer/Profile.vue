<template>
    <div class="min-h-screen bg-gray-50 dark:bg-navy-950">
        <Header />
        
        <main class="pt-24 pb-16 px-6">
            <div class="max-w-5xl mx-auto">
                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Profile</h1>
                    <p class="text-gray-600 dark:text-navy-400 mt-2">Manage your account information and preferences</p>
                </div>

                <!-- Success Message -->
                <div v-if="$page.props.flash?.success" class="mb-6 bg-green-50 border-2 border-green-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-green-800 font-medium">{{ $page.props.flash.success }}</p>
                    </div>
                </div>

                <!-- Error Messages -->
                <div v-if="$page.props.errors && Object.keys($page.props.errors).length > 0" class="mb-6 bg-red-50 border-2 border-red-200 rounded-xl p-4">
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

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white dark:bg-navy-800 rounded-2xl shadow-sm border border-gray-200 dark:border-navy-700 p-6 sticky top-24">
                            <!-- Avatar Section -->
                            <div class="text-center mb-6">
                                <div class="relative inline-block">
                                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold text-3xl shadow-lg mx-auto">
                                        {{ customer.initials }}
                                    </div>
                                    <button class="absolute bottom-0 right-0 h-8 w-8 bg-white dark:bg-navy-700 rounded-full shadow-lg border-2 border-gray-200 dark:border-navy-600 flex items-center justify-center hover:bg-gray-50 dark:hover:bg-navy-600 transition-colors">
                                        <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <h2 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">{{ customer.name }}</h2>
                                <p class="text-sm text-gray-500 dark:text-navy-400">{{ customer.email }}</p>
                            </div>

                            <!-- Quick Stats -->
                            <div class="space-y-3 pt-4 border-t border-gray-200 dark:border-navy-700">
                                <div class="flex items-center text-sm">
                                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-600 dark:text-navy-400">Joined {{ formatDate(customer.created_at) }}</span>
                                </div>
                                <div v-if="customer.city || customer.country" class="flex items-center text-sm">
                                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-gray-600 dark:text-navy-400">{{ [customer.city, customer.country].filter(Boolean).join(', ') || 'Not specified' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Personal Information -->
                        <div class="bg-white dark:bg-navy-800 rounded-2xl shadow-sm border border-gray-200 dark:border-navy-700 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Personal Information</h3>
                                <button 
                                    v-if="!editingPersonal"
                                    @click="editingPersonal = true"
                                    class="text-sm font-medium text-primary-600 hover:text-primary-700 flex items-center"
                                >
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                            </div>

                            <form v-if="editingPersonal" @submit.prevent="updatePersonalInfo" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Full Name</label>
                                        <input 
                                            v-model="personalForm.name"
                                            type="text" 
                                            required
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Email Address</label>
                                        <input 
                                            v-model="personalForm.email"
                                            type="email" 
                                            required
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Phone Number</label>
                                        <input 
                                            v-model="personalForm.phone"
                                            type="tel" 
                                            placeholder="+1234567890"
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Age -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Age</label>
                                        <input 
                                            v-model.number="personalForm.age"
                                            type="number" 
                                            min="1"
                                            max="120"
                                            placeholder="Enter your age"
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Gender -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Gender</label>
                                        <select 
                                            v-model="personalForm.gender"
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        >
                                            <option value="">Select gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                            <option value="prefer_not_to_say">Prefer not to say</option>
                                        </select>
                                    </div>

                                    <!-- City -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">City</label>
                                        <input 
                                            v-model="personalForm.city"
                                            type="text" 
                                            placeholder="Your city"
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Country -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Country</label>
                                        <input 
                                            v-model="personalForm.country"
                                            type="text" 
                                            placeholder="Your country"
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>
                                </div>

                                <!-- Bio -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Bio</label>
                                    <textarea 
                                        v-model="personalForm.bio"
                                        rows="3"
                                        placeholder="Tell us about yourself..."
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"
                                    ></textarea>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-end space-x-3 pt-4">
                                    <button 
                                        type="button"
                                        @click="cancelPersonalEdit"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-navy-300 bg-gray-100 dark:bg-navy-700 hover:bg-gray-200 dark:hover:bg-navy-600 rounded-lg transition"
                                    >
                                        Cancel
                                    </button>
                                    <button 
                                        type="submit"
                                        :disabled="processing"
                                        class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition disabled:opacity-50"
                                    >
                                        {{ processing ? 'Saving...' : 'Save Changes' }}
                                    </button>
                                </div>
                            </form>

                            <!-- View Mode -->
                            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Full Name</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ customer.name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Email</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ customer.email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Phone</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ customer.phone || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Age</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ customer.age || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Gender</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ formatGender(customer.gender) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Location</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ [customer.city, customer.country].filter(Boolean).join(', ') || 'Not provided' }}</p>
                                </div>
                                <div v-if="customer.bio" class="md:col-span-2">
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Bio</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ customer.bio }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information -->
                        <div class="bg-white dark:bg-navy-800 rounded-2xl shadow-sm border border-gray-200 dark:border-navy-700 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Professional Information</h3>
                                <button 
                                    v-if="!editingProfessional"
                                    @click="editingProfessional = true"
                                    class="text-sm font-medium text-primary-600 hover:text-primary-700 flex items-center"
                                >
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                            </div>

                            <form v-if="editingProfessional" @submit.prevent="updateProfessionalInfo" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Qualification -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Qualification</label>
                                        <input 
                                            v-model="professionalForm.qualification"
                                            type="text" 
                                            placeholder="e.g., Bachelor's in Computer Science"
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Occupation -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Occupation</label>
                                        <input 
                                            v-model="professionalForm.occupation"
                                            type="text" 
                                            placeholder="e.g., Cloud Engineer"
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>

                                    <!-- Company -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Company</label>
                                        <input 
                                            v-model="professionalForm.company"
                                            type="text" 
                                            placeholder="Your current company"
                                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                        />
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-end space-x-3 pt-4">
                                    <button 
                                        type="button"
                                        @click="cancelProfessionalEdit"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-navy-300 bg-gray-100 dark:bg-navy-700 hover:bg-gray-200 dark:hover:bg-navy-600 rounded-lg transition"
                                    >
                                        Cancel
                                    </button>
                                    <button 
                                        type="submit"
                                        :disabled="processing"
                                        class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition disabled:opacity-50"
                                    >
                                        {{ processing ? 'Saving...' : 'Save Changes' }}
                                    </button>
                                </div>
                            </form>

                            <!-- View Mode -->
                            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Qualification</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ customer.qualification || 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Occupation</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ customer.occupation || 'Not provided' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500 dark:text-navy-400 mb-1">Company</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ customer.company || 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Change Password -->
                        <div class="bg-white dark:bg-navy-800 rounded-2xl shadow-sm border border-gray-200 dark:border-navy-700 p-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Change Password</h3>
                            
                            <form @submit.prevent="updatePassword" class="space-y-4 max-w-md">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Current Password</label>
                                    <input 
                                        v-model="passwordForm.current_password"
                                        type="password" 
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">New Password</label>
                                    <input 
                                        v-model="passwordForm.password"
                                        type="password" 
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-navy-300 mb-2">Confirm New Password</label>
                                    <input 
                                        v-model="passwordForm.password_confirmation"
                                        type="password" 
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-navy-600 rounded-lg bg-white dark:bg-navy-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                    />
                                </div>
                                <button 
                                    type="submit"
                                    :disabled="processingPassword"
                                    class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition disabled:opacity-50"
                                >
                                    {{ processingPassword ? 'Updating...' : 'Update Password' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({
    customer: Object
});

const editingPersonal = ref(false);
const editingProfessional = ref(false);
const processing = ref(false);
const processingPassword = ref(false);

const personalForm = reactive({
    name: props.customer.name,
    email: props.customer.email,
    phone: props.customer.phone,
    age: props.customer.age,
    gender: props.customer.gender,
    city: props.customer.city,
    country: props.customer.country,
    bio: props.customer.bio
});

const professionalForm = reactive({
    qualification: props.customer.qualification,
    occupation: props.customer.occupation,
    company: props.customer.company
});

const passwordForm = reactive({
    current_password: '',
    password: '',
    password_confirmation: ''
});

const updatePersonalInfo = () => {
    processing.value = true;
    router.put(route('customer.profile.update'), personalForm, {
        preserveScroll: true,
        onSuccess: (page) => {
            editingPersonal.value = false;
            // Update the customer prop with new data
            if (page.props.customer) {
                Object.assign(props.customer, page.props.customer);
            }
        },
        onError: (errors) => {
            console.error('Update errors:', errors);
        },
        onFinish: () => {
            processing.value = false;
        }
    });
};

const updateProfessionalInfo = () => {
    processing.value = true;
    router.put(route('customer.profile.update'), professionalForm, {
        preserveScroll: true,
        onSuccess: (page) => {
            editingProfessional.value = false;
            // Update the customer prop with new data
            if (page.props.customer) {
                Object.assign(props.customer, page.props.customer);
            }
        },
        onError: (errors) => {
            console.error('Update errors:', errors);
        },
        onFinish: () => {
            processing.value = false;
        }
    });
};

const updatePassword = () => {
    processingPassword.value = true;
    router.put(route('customer.password.update'), passwordForm, {
        onSuccess: () => {
            passwordForm.current_password = '';
            passwordForm.password = '';
            passwordForm.password_confirmation = '';
        },
        onFinish: () => {
            processingPassword.value = false;
        }
    });
};

const cancelPersonalEdit = () => {
    editingPersonal.value = false;
    // Reset form
    personalForm.name = props.customer.name;
    personalForm.email = props.customer.email;
    personalForm.phone = props.customer.phone;
    personalForm.age = props.customer.age;
    personalForm.gender = props.customer.gender;
    personalForm.city = props.customer.city;
    personalForm.country = props.customer.country;
    personalForm.bio = props.customer.bio;
};

const cancelProfessionalEdit = () => {
    editingProfessional.value = false;
    // Reset form
    professionalForm.qualification = props.customer.qualification;
    professionalForm.occupation = props.customer.occupation;
    professionalForm.company = props.customer.company;
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long'
    });
};

const formatGender = (gender) => {
    if (!gender) return 'Not provided';
    return gender.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
};
</script>
