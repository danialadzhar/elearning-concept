<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';
import CourseCard from '@/Components/CourseCard.vue';
import CalendarWidget from '@/Components/CalendarWidget.vue';
import ScheduleWidget from '@/Components/ScheduleWidget.vue';
import HoursChart from '@/Components/HoursChart.vue';

// State untuk active tab
const activeTab = ref('upcoming');

// Sample data untuk courses
const courses = ref([
  {
    id: 1,
    title: 'Design Strategy',
    description: 'Lesson on planning a design concept and proper planning of work',
    tags: ['UX/UI Design', 'Web Design'],
    startDate: 'May 5',
    rating: '4.0',
    views: '3k, 009 rating',
    bgColor: '#C5E8E0',
    pattern: `
      <svg viewBox="0 0 200 200" class="w-full h-full">
        <circle cx="50" cy="100" r="40" stroke="currentColor" stroke-width="1" fill="none" opacity="0.3"/>
        <circle cx="150" cy="100" r="40" stroke="currentColor" stroke-width="1" fill="none" opacity="0.3"/>
        <line x1="20" y1="150" x2="180" y2="50" stroke="currentColor" stroke-width="1" opacity="0.3"/>
      </svg>
    `
  },
  {
    id: 2,
    title: 'English lecture',
    description: 'Language lessons with the most popular teachers',
    tags: ['Languages'],
    startDate: 'May 8',
    rating: '5.0',
    views: '3k, 009 rating',
    bgColor: '#D4C5F9',
    pattern: `
      <svg viewBox="0 0 200 200" class="w-full h-full">
        <circle cx="100" cy="100" r="50" stroke="currentColor" stroke-width="1" fill="none" opacity="0.3"/>
        <line x1="100" y1="50" x2="100" y2="150" stroke="currentColor" stroke-width="1" opacity="0.3"/>
        <line x1="50" y1="100" x2="150" y2="100" stroke="currentColor" stroke-width="1" opacity="0.3"/>
      </svg>
    `
  },
  {
    id: 3,
    title: 'Business lecture',
    description: 'Lecture on how to build your business using various new projects',
    tags: ['Marketing', 'Finance'],
    startDate: 'May 8',
    rating: '4.0',
    views: '3k, 009 rating',
    bgColor: '#F5D7C3',
    pattern: `
      <svg viewBox="0 0 200 200" class="w-full h-full">
        <polygon points="100,50 150,150 50,150" stroke="currentColor" stroke-width="1" fill="none" opacity="0.3"/>
        <line x1="100" y1="100" x2="100" y2="150" stroke="currentColor" stroke-width="1" opacity="0.3"/>
        <circle cx="100" cy="75" r="15" stroke="currentColor" stroke-width="1" fill="none" opacity="0.3"/>
      </svg>
    `
  }
]);

// Sample data untuk schedule
const schedules = ref([
  {
    id: 1,
    day: '05',
    title: 'UX/UI workshop',
    students: '@J.K Rowling',
    time: '18:00 - 19:00',
    highlighted: true
  },
  {
    id: 2,
    day: '06',
    title: 'English',
    students: '@J.K Rowling',
    time: '11:00 - 12:30'
  },
  {
    id: 3,
    day: '07',
    title: 'Product Design',
    students: '@J.K Rowling',
    time: '14:00 - 15:30'
  }
]);

// Sample data untuk hours chart
const hoursData = ref([
  { day: 'S', hours: 2 },
  { day: 'M', hours: 4 },
  { day: 'T', hours: 8, highlighted: true },
  { day: 'W', hours: 6 },
  { day: 'T', hours: 3 },
  { day: 'F', hours: 5 },
  { day: 'S', hours: 1 }
]);

const userName = 'Mia Lore';
</script>

<template>
  <Head title="Dashboard" />
  
  <div class="min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <Sidebar />
    
    <!-- Main Content -->
    <div class="lg:pl-20">
      <div class="flex flex-col lg:flex-row">
        <!-- Left Content Area -->
        <div class="flex-1 p-4 md:p-8">
          <!-- Header -->
          <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-1">
              Hi, {{ userName }} 👋
            </h1>
          </div>
          
          <!-- My Courses Section -->
          <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-2xl font-bold text-gray-900">My Courses</h2>
              <a href="#" class="text-sm text-gray-500 hover:text-gray-700">See all →</a>
            </div>
            
            <!-- Course Tabs -->
            <div class="flex space-x-6 mb-6 border-b border-gray-200">
              <button 
                @click="activeTab = 'all'"
                :class="[
                  'pb-3 text-sm font-medium transition-colors',
                  activeTab === 'all' 
                    ? 'text-gray-900 border-b-2 border-gray-900' 
                    : 'text-gray-500 hover:text-gray-700'
                ]"
              >
                All
              </button>
              <button 
                @click="activeTab = 'active'"
                :class="[
                  'pb-3 text-sm font-medium transition-colors',
                  activeTab === 'active' 
                    ? 'text-gray-900 border-b-2 border-gray-900' 
                    : 'text-gray-500 hover:text-gray-700'
                ]"
              >
                Active
              </button>
              <button 
                @click="activeTab = 'upcoming'"
                :class="[
                  'pb-3 text-sm font-medium transition-colors',
                  activeTab === 'upcoming' 
                    ? 'text-gray-900 border-b-2 border-gray-900' 
                    : 'text-gray-500 hover:text-gray-700'
                ]"
              >
                Upcoming
              </button>
              <button 
                @click="activeTab = 'completed'"
                :class="[
                  'pb-3 text-sm font-medium transition-colors',
                  activeTab === 'completed' 
                    ? 'text-gray-900 border-b-2 border-gray-900' 
                    : 'text-gray-500 hover:text-gray-700'
                ]"
              >
                Completed
              </button>
            </div>
            
            <!-- Course Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
              <CourseCard 
                v-for="course in courses" 
                :key="course.id"
                :course="course"
              />
            </div>
          </div>
        </div>
        
        <!-- Right Sidebar - Calendar & Schedule -->
        <div class="lg:w-96 p-4 md:p-8 space-y-6">
          <!-- Calendar -->
          <CalendarWidget />
          
          <!-- Schedule -->
          <ScheduleWidget :schedules="schedules" />
          
          <!-- Hours Chart -->
          <HoursChart :data="hoursData" />
        </div>
      </div>
    </div>
    
    <!-- Mobile Bottom Navigation -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-6 py-3">
      <div class="flex justify-around">
        <button class="flex flex-col items-center text-gray-900">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          <span class="text-xs mt-1">Home</span>
        </button>
        <button class="flex flex-col items-center text-gray-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <span class="text-xs mt-1">Calendar</span>
        </button>
        <button class="flex flex-col items-center text-gray-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          <span class="text-xs mt-1">Stats</span>
        </button>
        <button class="flex flex-col items-center text-gray-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          <span class="text-xs mt-1">Profile</span>
        </button>
      </div>
    </div>
  </div>
</template>