<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  course: {
    type: Object,
    required: true
  }
});
</script>

<template>
  <Link :href="`/course/${course.id}`"
    class="block bg-white rounded-2xl overflow-hidden hover:shadow-lg transition-shadow duration-300">
  <!-- Course Thumbnail -->
  <div class="relative h-40" :style="{ backgroundColor: course.bgColor }">
    <div class="absolute inset-0 flex items-center justify-center opacity-20">
      <!-- Pattern design - simple geometric -->
      <div class="w-full h-full" v-html="course.pattern"></div>
    </div>
  </div>

  <!-- Course Content -->
  <div class="p-6">
    <div class="flex items-start justify-between mb-2">
      <h3 class="text-lg font-semibold text-gray-900">{{ course.title }}</h3>
      <span class="text-xs text-gray-500 whitespace-nowrap ml-2">Start {{ course.startDate }}</span>
    </div>

    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ course.description }}</p>

    <!-- Tags -->
    <div class="flex flex-wrap gap-2 mb-4">
      <span v-for="tag in course.tags" :key="tag"
        class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">
        {{ tag }}
      </span>
    </div>

    <!-- Rating dan Views -->
    <div class="flex items-center justify-between text-sm">
      <div class="flex items-center text-gray-600">
        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>
        <span class="font-medium">{{ course.rating }}</span>
      </div>
      <span class="text-gray-500">{{ course.views }}</span>
    </div>
  </div>
  </Link>
</template>
