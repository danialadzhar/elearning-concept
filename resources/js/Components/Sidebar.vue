<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

// Dapatkan current page URL
const page = usePage();
const currentUrl = computed(() => page.url);

// Icons untuk navigation
const navItems = [
  { name: 'home', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', href: '/dashboard' },
  // { name: 'calendar', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', href: '/house' },
  // { name: 'chart', icon: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', href: '/dashboard' },
  // { name: 'folder', icon: 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z', href: '/dashboard' },
  // { name: 'bookmark', icon: 'M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z', href: '/dashboard' }
];

// Function untuk check jika page aktif
const isActive = (href) => {
  return currentUrl.value === href;
};
</script>

<template>
  <!-- Sidebar untuk desktop -->
  <div class="hidden lg:flex lg:flex-col lg:w-20 lg:fixed lg:inset-y-0 bg-gray-900">
    <!-- Logo -->
    <div class="flex items-center justify-center h-20">
      <div
        class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
        <span class="text-white font-bold text-xl">E</span>
      </div>
    </div>

    <!-- Navigation Icons -->
    <nav class="flex-1 flex flex-col items-center space-y-8 py-8">
      <Link v-for="item in navItems" :key="item.name" :href="item.href" :class="[
        'transition-colors duration-200 relative',
        isActive(item.href)
          ? 'text-purple-500'
          : 'text-gray-400 hover:text-white'
      ]">
      <!-- Indicator untuk active page -->
      <div v-if="isActive(item.href)"
        class="absolute -left-10 top-1/2 -translate-y-1/2 w-1 h-8 bg-purple-500 rounded-r-full"></div>

      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon" />
      </svg>
      </Link>
    </nav>
  </div>
</template>
