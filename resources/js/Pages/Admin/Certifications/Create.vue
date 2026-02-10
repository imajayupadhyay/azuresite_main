<template>
    <div class="min-h-screen bg-gray-50">
        <Sidebar />
        <Topbar title="Add Certification" subtitle="Create a new Azure certification" />

        <main class="ml-64 pt-16">
            <div class="p-6">
                <div class="max-w-5xl mx-auto">
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <!-- Basic Information -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                                    <select
                                        v-model="form.certification_category_id"
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                        <option value="">Select category</option>
                                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Code *</label>
                                    <input
                                        v-model="form.code"
                                        type="text"
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., AZ-900"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., Azure Fundamentals"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                                    <input
                                        v-model="form.slug"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Auto-generated"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Level Color *</label>
                                    <select
                                        v-model="form.level_color"
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                        <option value="green">Green (Foundation)</option>
                                        <option value="blue">Blue (Associate)</option>
                                        <option value="purple">Purple (Expert)</option>
                                        <option value="orange">Orange (Specialty)</option>
                                    </select>
                                </div>

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

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Short Description *</label>
                                    <textarea
                                        v-model="form.description"
                                        rows="2"
                                        required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                        placeholder="Brief description for card view..."
                                    ></textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Long Description</label>
                                    <textarea
                                        v-model="form.long_description"
                                        rows="4"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                        placeholder="Detailed description for certification page..."
                                    ></textarea>
                                </div>

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
                        </div>

                        <!-- Exam Details -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Exam Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Exam Duration</label>
                                    <input
                                        v-model="form.exam_duration"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., 60 minutes"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Questions</label>
                                    <input
                                        v-model="form.questions"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., 40-60"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Passing Score</label>
                                    <input
                                        v-model="form.passing_score"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., 700/1000"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Exam Cost</label>
                                    <input
                                        v-model="form.exam_cost"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., $165 USD"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Prep Time</label>
                                    <input
                                        v-model="form.duration"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., 1-2 months"
                                    />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Updated</label>
                                    <input
                                        v-model="form.last_updated"
                                        type="text"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., January 2024"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Prerequisites -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Prerequisites</h3>
                                <button
                                    type="button"
                                    @click="addPrerequisite"
                                    class="text-sm text-blue-600 hover:text-blue-800"
                                >
                                    + Add Prerequisite
                                </button>
                            </div>
                            <div class="space-y-2">
                                <div v-for="(prereq, index) in form.prerequisites" :key="index" class="flex gap-2">
                                    <input
                                        v-model="form.prerequisites[index]"
                                        type="text"
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Enter prerequisite..."
                                    />
                                    <button
                                        type="button"
                                        @click="removePrerequisite(index)"
                                        class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg"
                                    >
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                <p v-if="form.prerequisites.length === 0" class="text-sm text-gray-500">No prerequisites added yet.</p>
                            </div>
                        </div>

                        <!-- Target Audience -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Target Audience</h3>
                                <button
                                    type="button"
                                    @click="addTargetAudience"
                                    class="text-sm text-blue-600 hover:text-blue-800"
                                >
                                    + Add Target Audience
                                </button>
                            </div>
                            <div class="space-y-2">
                                <div v-for="(audience, index) in form.target_audience" :key="index" class="flex gap-2">
                                    <input
                                        v-model="form.target_audience[index]"
                                        type="text"
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., Cloud Administrators"
                                    />
                                    <button
                                        type="button"
                                        @click="removeTargetAudience(index)"
                                        class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg"
                                    >
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                <p v-if="form.target_audience.length === 0" class="text-sm text-gray-500">No target audience added yet.</p>
                            </div>
                        </div>

                        <!-- Modules/Curriculum -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Curriculum Modules</h3>
                                <button
                                    type="button"
                                    @click="addModule"
                                    class="text-sm text-blue-600 hover:text-blue-800"
                                >
                                    + Add Module
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div v-for="(module, mIndex) in form.modules" :key="mIndex" class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <span class="text-sm font-semibold text-gray-700">Module {{ module.number }}</span>
                                        <button
                                            type="button"
                                            @click="removeModule(mIndex)"
                                            class="text-red-600 hover:text-red-800"
                                        >
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                        <input
                                            v-model="module.title"
                                            type="text"
                                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Module title"
                                        />
                                        <input
                                            v-model="module.duration"
                                            type="text"
                                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., 2 hours"
                                        />
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-medium text-gray-500">Lessons</span>
                                            <button
                                                type="button"
                                                @click="addLesson(mIndex)"
                                                class="text-xs text-blue-600 hover:text-blue-800"
                                            >
                                                + Add Lesson
                                            </button>
                                        </div>
                                        <div v-for="(lesson, lIndex) in module.lessons" :key="lIndex" class="flex gap-2">
                                            <input
                                                v-model="module.lessons[lIndex]"
                                                type="text"
                                                class="flex-1 px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                placeholder="Lesson title"
                                            />
                                            <button
                                                type="button"
                                                @click="removeLesson(mIndex, lIndex)"
                                                class="px-2 text-red-500 hover:text-red-700"
                                            >
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p v-if="form.modules.length === 0" class="text-sm text-gray-500">No modules added yet.</p>
                            </div>
                        </div>

                        <!-- Skills Measured -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Skills Measured</h3>
                                <button
                                    type="button"
                                    @click="addSkill"
                                    class="text-sm text-blue-600 hover:text-blue-800"
                                >
                                    + Add Skill
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div v-for="(skill, sIndex) in form.skills" :key="sIndex" class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                                            <input
                                                v-model="skill.name"
                                                type="text"
                                                class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                placeholder="Skill area name"
                                            />
                                            <input
                                                v-model="skill.weight"
                                                type="text"
                                                class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                placeholder="e.g., 25-30%"
                                            />
                                        </div>
                                        <button
                                            type="button"
                                            @click="removeSkill(sIndex)"
                                            class="ml-3 text-red-600 hover:text-red-800"
                                        >
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-medium text-gray-500">Topics</span>
                                            <button
                                                type="button"
                                                @click="addTopic(sIndex)"
                                                class="text-xs text-blue-600 hover:text-blue-800"
                                            >
                                                + Add Topic
                                            </button>
                                        </div>
                                        <div v-for="(topic, tIndex) in skill.topics" :key="tIndex" class="flex gap-2">
                                            <input
                                                v-model="skill.topics[tIndex]"
                                                type="text"
                                                class="flex-1 px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                placeholder="Topic"
                                            />
                                            <button
                                                type="button"
                                                @click="removeTopic(sIndex, tIndex)"
                                                class="px-2 text-red-500 hover:text-red-700"
                                            >
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p v-if="form.skills.length === 0" class="text-sm text-gray-500">No skills added yet.</p>
                            </div>
                        </div>

                        <!-- Resources -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Resources</h3>
                                <button
                                    type="button"
                                    @click="addResource"
                                    class="text-sm text-blue-600 hover:text-blue-800"
                                >
                                    + Add Resource
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div v-for="(resource, rIndex) in form.resources" :key="rIndex" class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <span class="text-sm font-semibold text-gray-700">Resource {{ rIndex + 1 }}</span>
                                        <button
                                            type="button"
                                            @click="removeResource(rIndex)"
                                            class="text-red-600 hover:text-red-800"
                                        >
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <select
                                            v-model="resource.icon"
                                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        >
                                            <option value="microsoft">Microsoft</option>
                                            <option value="test">Practice Test</option>
                                            <option value="video">Video</option>
                                            <option value="code">Code/Labs</option>
                                        </select>
                                        <input
                                            v-model="resource.title"
                                            type="text"
                                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Resource title"
                                        />
                                        <input
                                            v-model="resource.description"
                                            type="text"
                                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Short description"
                                        />
                                        <input
                                            v-model="resource.url"
                                            type="url"
                                            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="https://..."
                                        />
                                    </div>
                                </div>
                                <p v-if="form.resources.length === 0" class="text-sm text-gray-500">No resources added yet.</p>
                            </div>
                        </div>

                        <!-- FAQs -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900">FAQs</h3>
                                <button
                                    type="button"
                                    @click="addFaq"
                                    class="text-sm text-blue-600 hover:text-blue-800"
                                >
                                    + Add FAQ
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div v-for="(faq, fIndex) in form.faqs" :key="fIndex" class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <span class="text-sm font-semibold text-gray-700">FAQ {{ fIndex + 1 }}</span>
                                        <button
                                            type="button"
                                            @click="removeFaq(fIndex)"
                                            class="text-red-600 hover:text-red-800"
                                        >
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-3">
                                        <input
                                            v-model="faq.question"
                                            type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Question"
                                        />
                                        <textarea
                                            v-model="faq.answer"
                                            rows="2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                            placeholder="Answer"
                                        ></textarea>
                                    </div>
                                </div>
                                <p v-if="form.faqs.length === 0" class="text-sm text-gray-500">No FAQs added yet.</p>
                            </div>
                        </div>

                        <!-- SEO -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">SEO</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                    <input
                                        v-model="form.meta_title"
                                        type="text"
                                        maxlength="70"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="SEO title (max 70 chars)"
                                    />
                                    <p class="text-xs text-gray-500 mt-1">{{ (form.meta_title || '').length }}/70 characters</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                    <textarea
                                        v-model="form.meta_description"
                                        rows="2"
                                        maxlength="160"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                        placeholder="SEO description (max 160 chars)"
                                    ></textarea>
                                    <p class="text-xs text-gray-500 mt-1">{{ (form.meta_description || '').length }}/160 characters</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-3">
                            <a
                                :href="route('admin.certifications.index')"
                                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition"
                            >
                                Cancel
                            </a>
                            <button
                                type="submit"
                                :disabled="processing"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition disabled:opacity-50"
                            >
                                {{ processing ? 'Creating...' : 'Create Certification' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Sidebar from '../Global/Sidebar.vue';
import Topbar from '../Global/Topbar.vue';

const props = defineProps({
    categories: Array,
});

const processing = ref(false);

const form = ref({
    certification_category_id: '',
    code: '',
    name: '',
    slug: '',
    description: '',
    long_description: '',
    level_color: 'blue',
    exam_duration: '',
    questions: '',
    passing_score: '',
    exam_cost: '',
    duration: '',
    last_updated: '',
    prerequisites: [],
    target_audience: [],
    modules: [],
    skills: [],
    resources: [],
    faqs: [],
    meta_title: '',
    meta_description: '',
    order: 0,
    is_active: true,
});

// Prerequisites
const addPrerequisite = () => form.value.prerequisites.push('');
const removePrerequisite = (index) => form.value.prerequisites.splice(index, 1);

// Target Audience
const addTargetAudience = () => form.value.target_audience.push('');
const removeTargetAudience = (index) => form.value.target_audience.splice(index, 1);

// Modules
const addModule = () => {
    form.value.modules.push({
        number: form.value.modules.length + 1,
        title: '',
        duration: '',
        lessons: []
    });
};
const removeModule = (index) => {
    form.value.modules.splice(index, 1);
    form.value.modules.forEach((m, i) => m.number = i + 1);
};
const addLesson = (moduleIndex) => form.value.modules[moduleIndex].lessons.push('');
const removeLesson = (moduleIndex, lessonIndex) => form.value.modules[moduleIndex].lessons.splice(lessonIndex, 1);

// Skills
const addSkill = () => {
    form.value.skills.push({
        name: '',
        weight: '',
        topics: []
    });
};
const removeSkill = (index) => form.value.skills.splice(index, 1);
const addTopic = (skillIndex) => form.value.skills[skillIndex].topics.push('');
const removeTopic = (skillIndex, topicIndex) => form.value.skills[skillIndex].topics.splice(topicIndex, 1);

// Resources
const addResource = () => {
    form.value.resources.push({
        icon: 'microsoft',
        title: '',
        description: '',
        url: ''
    });
};
const removeResource = (index) => form.value.resources.splice(index, 1);

// FAQs
const addFaq = () => {
    form.value.faqs.push({
        question: '',
        answer: ''
    });
};
const removeFaq = (index) => form.value.faqs.splice(index, 1);

const submitForm = () => {
    processing.value = true;

    // Filter out empty values
    const data = {
        ...form.value,
        prerequisites: form.value.prerequisites.filter(p => p.trim()),
        target_audience: form.value.target_audience.filter(t => t.trim()),
        modules: form.value.modules.filter(m => m.title.trim()).map(m => ({
            ...m,
            lessons: m.lessons.filter(l => l.trim())
        })),
        skills: form.value.skills.filter(s => s.name.trim()).map(s => ({
            ...s,
            topics: s.topics.filter(t => t.trim())
        })),
        resources: form.value.resources.filter(r => r.title.trim() && r.url.trim()),
        faqs: form.value.faqs.filter(f => f.question.trim() && f.answer.trim()),
    };

    router.post(route('admin.certifications.store'), data, {
        onFinish: () => {
            processing.value = false;
        }
    });
};
</script>
