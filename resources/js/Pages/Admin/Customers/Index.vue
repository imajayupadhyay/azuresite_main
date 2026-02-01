<template>
    <div class="min-h-screen bg-gray-50">
        <Sidebar />
        <Topbar title="Customer Management" subtitle="Manage all registered customers" />

        <main class="ml-64 pt-16">
            <div class="p-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Customers</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ stats.total }}</p>
                                </div>
                                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">With Profile</p>
                                    <p class="text-2xl font-bold text-green-600 mt-1">{{ stats.with_profile }}</p>
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
                                    <p class="text-sm font-medium text-gray-600">Male</p>
                                    <p class="text-2xl font-bold text-indigo-600 mt-1">{{ stats.male }}</p>
                                </div>
                                <div class="h-12 w-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Female</p>
                                    <p class="text-2xl font-bold text-pink-600 mt-1">{{ stats.female }}</p>
                                </div>
                                <div class="h-12 w-12 bg-pink-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters and Export -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                    <input
                                        v-model="filterForm.search"
                                        type="text"
                                        placeholder="Search by name or email..."
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        @input="debounceFilter"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                    <select
                                        v-model="filterForm.gender"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        @change="applyFilters"
                                    >
                                        <option value="">All Genders</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                        <option value="prefer_not_to_say">Prefer not to say</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                    <input
                                        v-model="filterForm.city"
                                        type="text"
                                        placeholder="Filter by city..."
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        @input="debounceFilter"
                                    />
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
                                    :href="route('admin.customers.export', filterForm)"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-200"
                                >
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Export CSV
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Customers Table -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="customer in customers.data" :key="customer.id" class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                                    {{ customer.initials }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ customer.name }}</div>
                                                    <div class="text-sm text-gray-500">ID: {{ customer.id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ customer.email }}</div>
                                            <div class="text-sm text-gray-500">{{ customer.phone || 'No phone' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ customer.age ? `Age: ${customer.age}` : 'No age' }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ formatGender(customer.gender) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ formatDate(customer.created_at) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button
                                                @click="viewCustomer(customer)"
                                                class="text-blue-600 hover:text-blue-900 mr-3"
                                            >
                                                View/Edit
                                            </button>
                                            <button
                                                @click="deleteCustomer(customer)"
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="customers.data.length === 0">
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            No customers found
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div v-if="customers.links.length > 3" class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-700">
                                    Showing {{ customers.from }} to {{ customers.to }} of {{ customers.total }} results
                                </div>
                                <div class="flex space-x-2">
                                    <Link
                                        v-for="(link, index) in customers.links"
                                        :key="index"
                                        :href="link.url"
                                        :class="[
                                            'px-3 py-2 text-sm rounded-lg transition duration-200',
                                            link.active
                                                ? 'bg-blue-600 text-white'
                                                : link.url
                                                    ? 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300'
                                                    : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                                        ]"
                                        v-html="link.label"
                                        :disabled="!link.url"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- View/Edit Customer Modal -->
        <div v-if="selectedCustomer" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <div class="h-16 w-16 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                {{ selectedCustomer.initials }}
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">{{ selectedCustomer.name }}</h3>
                                <p class="text-sm text-gray-500">Customer ID: {{ selectedCustomer.id }}</p>
                            </div>
                        </div>
                        <button @click="selectedCustomer = null" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="border-b border-gray-200">
                    <div class="flex px-6">
                        <button
                            @click="activeTab = 'details'"
                            :class="[
                                'px-4 py-3 text-sm font-medium border-b-2 transition-colors',
                                activeTab === 'details'
                                    ? 'border-blue-600 text-blue-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700'
                            ]"
                        >
                            Customer Details
                        </button>
                        <button
                            @click="activeTab = 'password'"
                            :class="[
                                'px-4 py-3 text-sm font-medium border-b-2 transition-colors',
                                activeTab === 'password'
                                    ? 'border-blue-600 text-blue-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700'
                            ]"
                        >
                            Reset Password
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Customer Details Tab -->
                    <div v-if="activeTab === 'details'">
                        <form @submit.prevent="updateCustomer" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                    <input
                                        v-model="editForm.name"
                                        type="text"
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                    <input
                                        v-model="editForm.email"
                                        type="email"
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                    <input
                                        v-model="editForm.phone"
                                        type="tel"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Age -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                                    <input
                                        v-model.number="editForm.age"
                                        type="number"
                                        min="1"
                                        max="120"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                    <select
                                        v-model="editForm.gender"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                    <input
                                        v-model="editForm.city"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Country -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                    <input
                                        v-model="editForm.country"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Qualification -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Qualification</label>
                                    <input
                                        v-model="editForm.qualification"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Occupation -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                                    <input
                                        v-model="editForm.occupation"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Company -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                                    <input
                                        v-model="editForm.company"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                </div>

                                <!-- Bio -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                    <textarea
                                        v-model="editForm.bio"
                                        rows="3"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                    ></textarea>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                                <button
                                    type="button"
                                    @click="selectedCustomer = null"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    :disabled="updating"
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition disabled:opacity-50"
                                >
                                    {{ updating ? 'Updating...' : 'Update Customer' }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Reset Password Tab -->
                    <div v-if="activeTab === 'password'">
                        <form @submit.prevent="resetCustomerPassword" class="space-y-4 max-w-md">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                <div class="flex items-start">
                                    <svg class="h-5 w-5 text-yellow-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <p class="text-sm text-yellow-800">
                                        You are about to reset the password for <strong>{{ selectedCustomer.name }}</strong>. The customer will need to use the new password to login.
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input
                                    v-model="passwordForm.password"
                                    type="password"
                                    required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                <input
                                    v-model="passwordForm.password_confirmation"
                                    type="password"
                                    required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-3 pt-4">
                                <button
                                    type="button"
                                    @click="selectedCustomer = null"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    :disabled="resettingPassword"
                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition disabled:opacity-50"
                                >
                                    {{ resettingPassword ? 'Resetting...' : 'Reset Password' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import Sidebar from '../Global/Sidebar.vue';
import Topbar from '../Global/Topbar.vue';

const props = defineProps({
    customers: Object,
    stats: Object,
    filters: Object
});

const filterForm = reactive({
    search: props.filters.search || '',
    gender: props.filters.gender || '',
    city: props.filters.city || ''
});

const selectedCustomer = ref(null);
const activeTab = ref('details');
const updating = ref(false);
const resettingPassword = ref(false);

const editForm = reactive({
    name: '',
    email: '',
    phone: '',
    age: null,
    gender: '',
    city: '',
    country: '',
    qualification: '',
    occupation: '',
    company: '',
    bio: ''
});

const passwordForm = reactive({
    password: '',
    password_confirmation: ''
});

let debounceTimeout = null;

const debounceFilter = () => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        applyFilters();
    }, 500);
};

const applyFilters = () => {
    router.get(route('admin.customers.index'), filterForm, {
        preserveState: true,
        preserveScroll: true
    });
};

const clearFilters = () => {
    filterForm.search = '';
    filterForm.gender = '';
    filterForm.city = '';
    applyFilters();
};

const viewCustomer = (customer) => {
    selectedCustomer.value = customer;
    activeTab.value = 'details';
    
    // Populate edit form
    editForm.name = customer.name;
    editForm.email = customer.email;
    editForm.phone = customer.phone;
    editForm.age = customer.age;
    editForm.gender = customer.gender;
    editForm.city = customer.city;
    editForm.country = customer.country;
    editForm.qualification = customer.qualification;
    editForm.occupation = customer.occupation;
    editForm.company = customer.company;
    editForm.bio = customer.bio;
};

const updateCustomer = () => {
    updating.value = true;
    router.put(route('admin.customers.update', selectedCustomer.value.id), editForm, {
        preserveScroll: true,
        onSuccess: () => {
            selectedCustomer.value = null;
        },
        onFinish: () => {
            updating.value = false;
        }
    });
};

const resetCustomerPassword = () => {
    if (!confirm(`Are you sure you want to reset password for ${selectedCustomer.value.name}?`)) {
        return;
    }

    resettingPassword.value = true;
    router.put(route('admin.customers.reset-password', selectedCustomer.value.id), passwordForm, {
        preserveScroll: true,
        onSuccess: () => {
            selectedCustomer.value = null;
            passwordForm.password = '';
            passwordForm.password_confirmation = '';
        },
        onFinish: () => {
            resettingPassword.value = false;
        }
    });
};

const deleteCustomer = (customer) => {
    if (confirm(`Are you sure you want to permanently delete ${customer.name}? This action cannot be undone.`)) {
        router.delete(route('admin.customers.destroy', customer.id));
    }
};

const formatGender = (gender) => {
    if (!gender) return 'Not specified';
    return gender.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
};
</script>
