<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';

// Props dari backend
const props = defineProps({
    course: {
        type: Object,
        required: true
    }
});

// State untuk active tab dan lesson
const activeTab = ref('lessons');
const currentLessonIndex = ref(0);

// Sample data untuk modules dan lessons
const modules = ref([
    {
        id: 1,
        title: 'Introduction',
        duration: '45 min',
        lessons: [
            { id: 1, title: 'Welcome to the course', duration: '5:30', completed: true, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' },
            { id: 2, title: 'Course overview', duration: '10:20', completed: true, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' },
            { id: 3, title: 'What you will learn', duration: '8:45', completed: false, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' }
        ]
    },
    {
        id: 2,
        title: 'Getting Started',
        duration: '1h 30min',
        lessons: [
            { id: 4, title: 'Setting up your workspace', duration: '15:30', completed: false, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' },
            { id: 5, title: 'Basic concepts', duration: '20:15', completed: false, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' },
            { id: 6, title: 'First project', duration: '25:40', completed: false, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' }
        ]
    },
    {
        id: 3,
        title: 'Advanced Topics',
        duration: '2h 15min',
        lessons: [
            { id: 7, title: 'Advanced techniques', duration: '30:00', completed: false, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' },
            { id: 8, title: 'Best practices', duration: '25:20', completed: false, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' },
            { id: 9, title: 'Real world examples', duration: '35:45', completed: false, video: 'https://www.youtube.com/embed/dQw4w9WgXcQ' }
        ]
    }
]);

// Expand/collapse state untuk modules
const expandedModules = ref([1]); // Module pertama expanded by default

// Toggle module expansion
const toggleModule = (moduleId) => {
    const index = expandedModules.value.indexOf(moduleId);
    if (index > -1) {
        expandedModules.value.splice(index, 1);
    } else {
        expandedModules.value.push(moduleId);
    }
};

// Check if module is expanded
const isModuleExpanded = (moduleId) => {
    return expandedModules.value.includes(moduleId);
};

// Get all lessons as flat array
const allLessons = computed(() => {
    return modules.value.flatMap(module => module.lessons);
});

// Current lesson
const currentLesson = computed(() => {
    return allLessons.value[currentLessonIndex.value] || allLessons.value[0];
});

// Progress calculation
const completedLessons = computed(() => {
    return allLessons.value.filter(lesson => lesson.completed).length;
});

const totalLessons = computed(() => {
    return allLessons.value.length;
});

const progressPercentage = computed(() => {
    return Math.round((completedLessons.value / totalLessons.value) * 100);
});

// Navigate lessons
const goToLesson = (lessonId) => {
    const index = allLessons.value.findIndex(lesson => lesson.id === lessonId);
    if (index !== -1) {
        currentLessonIndex.value = index;
    }
};

const previousLesson = () => {
    if (currentLessonIndex.value > 0) {
        currentLessonIndex.value--;
    }
};

const nextLesson = () => {
    if (currentLessonIndex.value < allLessons.value.length - 1) {
        // Mark current as completed
        currentLesson.value.completed = true;
        currentLessonIndex.value++;
    }
};

const markAsCompleted = () => {
    currentLesson.value.completed = !currentLesson.value.completed;
};
</script>

<template>

    <Head :title="course.title" />

    <div class="min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Main Content -->
        <div class="lg:pl-20">
            <div class="flex flex-col lg:flex-row h-screen">
                <!-- Video & Content Area -->
                <div class="flex-1 flex flex-col overflow-hidden">
                    <!-- Top Navigation -->
                    <div class="bg-white border-b border-gray-200 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <Link href="/dashboard" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                </Link>
                                <div>
                                    <h1 class="text-lg font-semibold text-gray-900">{{ course.title }}</h1>
                                    <p class="text-sm text-gray-500">{{ completedLessons }} / {{ totalLessons }} lessons
                                        completed</p>
                                </div>
                            </div>

                            <!-- Progress Badge -->
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-700">{{ progressPercentage }}%</span>
                                    <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-green-500 transition-all duration-300"
                                            :style="{ width: progressPercentage + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Video Player Area -->
                    <div class="flex-1 bg-black flex items-center justify-center overflow-hidden">
                        <div class="w-full h-full">
                            <!-- Guna iframe untuk video player atau boleh integrate video.js / plyr.io -->
                            <iframe :src="currentLesson.video" class="w-full h-full" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                    <!-- Video Controls & Info -->
                    <div class="bg-white border-t border-gray-200 px-6 py-4">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-900 mb-1">{{ currentLesson.title }}</h2>
                                <p class="text-sm text-gray-500">Module {{ Math.ceil((currentLessonIndex + 1) / 3) }} •
                                    {{ currentLesson.duration }}</p>
                            </div>

                            <button @click="markAsCompleted" :class="[
                                'px-4 py-2 rounded-lg font-medium transition-colors',
                                currentLesson.completed
                                    ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                            ]">
                                <span v-if="currentLesson.completed">✓ Completed</span>
                                <span v-else>Mark as complete</span>
                            </button>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex items-center space-x-3">
                            <button @click="previousLesson" :disabled="currentLessonIndex === 0" :class="[
                                'px-6 py-2 rounded-lg font-medium transition-colors',
                                currentLessonIndex === 0
                                    ? 'bg-gray-100 text-gray-400 cursor-not-allowed'
                                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                            ]">
                                ← Previous
                            </button>
                            <button @click="nextLesson" :disabled="currentLessonIndex === allLessons.length - 1" :class="[
                                'px-6 py-2 rounded-lg font-medium transition-colors',
                                currentLessonIndex === allLessons.length - 1
                                    ? 'bg-gray-100 text-gray-400 cursor-not-allowed'
                                    : 'bg-blue-600 text-white hover:bg-blue-700'
                            ]">
                                Next Lesson →
                            </button>
                        </div>
                    </div>

                    <!-- Tabs Section -->
                    <div class="bg-white border-t border-gray-200">
                        <div class="px-6">
                            <div class="flex space-x-8 border-b border-gray-200">
                                <button @click="activeTab = 'lessons'" :class="[
                                    'py-4 text-sm font-medium transition-colors',
                                    activeTab === 'lessons'
                                        ? 'text-blue-600 border-b-2 border-blue-600'
                                        : 'text-gray-500 hover:text-gray-700'
                                ]">
                                    Lessons
                                </button>
                                <button @click="activeTab = 'overview'" :class="[
                                    'py-4 text-sm font-medium transition-colors',
                                    activeTab === 'overview'
                                        ? 'text-blue-600 border-b-2 border-blue-600'
                                        : 'text-gray-500 hover:text-gray-700'
                                ]">
                                    Overview
                                </button>
                                <button @click="activeTab = 'resources'" :class="[
                                    'py-4 text-sm font-medium transition-colors',
                                    activeTab === 'resources'
                                        ? 'text-blue-600 border-b-2 border-blue-600'
                                        : 'text-gray-500 hover:text-gray-700'
                                ]">
                                    Resources
                                </button>
                                <button @click="activeTab = 'qna'" :class="[
                                    'py-4 text-sm font-medium transition-colors',
                                    activeTab === 'qna'
                                        ? 'text-blue-600 border-b-2 border-blue-600'
                                        : 'text-gray-500 hover:text-gray-700'
                                ]">
                                    Q&A
                                </button>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="px-6 py-6 max-h-64 overflow-y-auto">
                            <!-- Overview Tab -->
                            <div v-if="activeTab === 'overview'" class="prose prose-sm max-w-none">
                                <h3 class="text-lg font-semibold mb-3">About this course</h3>
                                <p class="text-gray-600 mb-4">{{ course.description }}</p>

                                <h4 class="font-semibold mb-2">What you'll learn</h4>
                                <ul class="space-y-2 text-gray-600">
                                    <li>✓ Master the fundamentals and advanced concepts</li>
                                    <li>✓ Build real-world projects from scratch</li>
                                    <li>✓ Best practices and industry standards</li>
                                    <li>✓ Problem solving and critical thinking</li>
                                </ul>

                                <div class="mt-4 flex flex-wrap gap-2">
                                    <span v-for="tag in course.tags" :key="tag"
                                        class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">
                                        {{ tag }}
                                    </span>
                                </div>
                            </div>

                            <!-- Lessons Tab -->
                            <div v-if="activeTab === 'lessons'" class="text-sm text-gray-600">
                                <p class="mb-2">Current lesson content and notes will appear here.</p>
                                <p class="text-xs text-gray-500">You can add interactive exercises, code snippets, or
                                    additional learning materials.</p>
                            </div>

                            <!-- Resources Tab -->
                            <div v-if="activeTab === 'resources'">
                                <h3 class="text-lg font-semibold mb-3">Course Resources</h3>
                                <div class="space-y-2">
                                    <a href="#"
                                        class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900">Course Slides.pdf</span>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                    <a href="#"
                                        class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900">Source Code.zip</span>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Q&A Tab -->
                            <div v-if="activeTab === 'qna'">
                                <h3 class="text-lg font-semibold mb-3">Questions & Answers</h3>
                                <div class="space-y-4">
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-start justify-between mb-2">
                                            <h4 class="font-medium text-gray-900">How do I get started?</h4>
                                            <span class="text-xs text-gray-500">2 days ago</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-2">I'm having trouble understanding the first
                                            concept...</p>
                                        <button class="text-xs text-blue-600 hover:text-blue-700 font-medium">View
                                            answer →</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar - Course Curriculum -->
                <div class="w-full lg:w-96 bg-white border-l border-gray-200 overflow-y-auto">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Course Content</h3>

                        <!-- Modules List -->
                        <div class="space-y-3">
                            <div v-for="module in modules" :key="module.id"
                                class="border border-gray-200 rounded-lg overflow-hidden">
                                <!-- Module Header -->
                                <button @click="toggleModule(module.id)"
                                    class="w-full px-4 py-3 bg-gray-50 hover:bg-gray-100 transition-colors flex items-center justify-between">
                                    <div class="text-left">
                                        <h4 class="font-medium text-gray-900 text-sm">{{ module.title }}</h4>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ module.lessons.length }} lessons • {{
                                            module.duration }}</p>
                                    </div>
                                    <svg :class="[
                                        'w-5 h-5 text-gray-400 transition-transform',
                                        isModuleExpanded(module.id) ? 'rotate-180' : ''
                                    ]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Lessons List -->
                                <div v-if="isModuleExpanded(module.id)" class="divide-y divide-gray-100">
                                    <button v-for="lesson in module.lessons" :key="lesson.id"
                                        @click="goToLesson(lesson.id)" :class="[
                                            'w-full px-4 py-3 hover:bg-blue-50 transition-colors flex items-center space-x-3 text-left',
                                            currentLesson.id === lesson.id ? 'bg-blue-50 border-l-2 border-blue-600' : ''
                                        ]">
                                        <!-- Play/Check Icon -->
                                        <div :class="[
                                            'flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center',
                                            lesson.completed ? 'bg-green-100' : 'bg-gray-100'
                                        ]">
                                            <svg v-if="lesson.completed" class="w-5 h-5 text-green-600"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg v-else-if="currentLesson.id === lesson.id"
                                                class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg v-else class="w-4 h-4 text-gray-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>

                                        <!-- Lesson Info -->
                                        <div class="flex-1 min-w-0">
                                            <p :class="[
                                                'text-sm font-medium truncate',
                                                currentLesson.id === lesson.id ? 'text-blue-600' : 'text-gray-900'
                                            ]">
                                                {{ lesson.title }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ lesson.duration }}</p>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
