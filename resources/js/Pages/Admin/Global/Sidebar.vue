<template>
    <aside class="fixed left-0 top-0 h-full w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm z-40">
        <!-- Logo Section -->
        <div class="h-16 flex items-center px-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="h-10 w-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">Admin</h1>
                    <p class="text-xs text-gray-500">Azure Skills</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 overflow-y-auto">
            <div class="space-y-1">
                <!-- Dashboard Link -->
                <Link
                    :href="route('admin.dashboard')"
                    :class="[
                        'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200',
                        isActive('admin.dashboard')
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                            : 'text-gray-700 hover:bg-gray-100'
                    ]"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </Link>

                <!-- Support Link -->
                <Link
                    :href="route('admin.support.index')"
                    :class="[
                        'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200',
                        isActive('admin.support')
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                            : 'text-gray-700 hover:bg-gray-100'
                    ]"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-medium">Support</span>
                </Link>

                <!-- Newsletter Link -->
                <Link
                    :href="route('admin.newsletter.index')"
                    :class="[
                        'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200',
                        isActive('admin.newsletter')
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                            : 'text-gray-700 hover:bg-gray-100'
                    ]"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Newsletter</span>
                </Link>

                <!-- Customers Link -->
                <Link
                    :href="route('admin.customers.index')"
                    :class="[
                        'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200',
                        isActive('admin.customers')
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                            : 'text-gray-700 hover:bg-gray-100'
                    ]"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-medium">Customers</span>
                </Link>
            </div>

            <!-- Services Section Divider -->
            <div class="px-4 pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Services</p>
            </div>

            <div class="space-y-1">
                <!-- Service Categories Link -->
                <Link
                    :href="route('admin.services.categories.index')"
                    :class="[
                        'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200',
                        isActive('admin.services.categories')
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                            : 'text-gray-700 hover:bg-gray-100'
                    ]"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span class="font-medium">Categories</span>
                </Link>

                <!-- Services Link -->
                <Link
                    :href="route('admin.services.index')"
                    :class="[
                        'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200',
                        isActive('admin.services.index')
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                            : 'text-gray-700 hover:bg-gray-100'
                    ]"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="font-medium">Services</span>
                </Link>
            </div>

            <!-- Certifications Section Divider -->
            <div class="px-4 pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Certifications</p>
            </div>

            <div class="space-y-1">
                <!-- Certification Categories Link -->
                <Link
                    :href="route('admin.certifications.categories.index')"
                    :class="[
                        'flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200',
                        isActive('admin.certifications.categories')
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md'
                            : 'text-gray-700 hover:bg-gray-100'
                    ]"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <span class="font-medium">Categories</span>
                </Link>
            </div>
        </nav>

        <!-- User Section -->
        <div class="border-t border-gray-200 p-4">
            <div class="flex items-center space-x-3 px-2">
                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">
                        {{ getInitials($page.props.auth?.user?.name) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                        {{ $page.props.auth?.user?.name || 'Admin' }}
                    </p>
                    <p class="text-xs text-gray-500 truncate">
                        {{ $page.props.auth?.user?.email || '' }}
                    </p>
                </div>
            </div>
        </div>
    </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const isActive = (routePattern) => {
    // Check exact match first
    if (route().current(routePattern)) return true;
    // Check if any nested route matches (e.g., admin.support.index, admin.support.show)
    return route().current(routePattern + '.*');
};

const getInitials = (name) => {
    if (!name) return 'A';
    return name
        .split(' ')
        .map(word => word[0])
        .join('')
        .toUpperCase()
        .substring(0, 2);
};
</script>
