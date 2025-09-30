<script setup>
import { ref, computed } from 'vue';

const currentMonth = ref(new Date());
const selectedDate = ref(new Date());

// Generate calendar days
const calendarDays = computed(() => {
  const year = currentMonth.value.getFullYear();
  const month = currentMonth.value.getMonth();
  
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const daysInMonth = lastDay.getDate();
  const startingDayOfWeek = firstDay.getDay();
  
  const days = [];
  
  // Empty cells untuk alignment
  for (let i = 0; i < startingDayOfWeek; i++) {
    days.push(null);
  }
  
  // Actual days
  for (let day = 1; day <= daysInMonth; day++) {
    days.push(new Date(year, month, day));
  }
  
  return days;
});

const monthYear = computed(() => {
  return currentMonth.value.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
});

const weekDays = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

const isToday = (date) => {
  if (!date) return false;
  const today = new Date();
  return date.toDateString() === today.toDateString();
};

const isSelected = (date) => {
  if (!date) return false;
  return date.toDateString() === selectedDate.value.toDateString();
};

const previousMonth = () => {
  currentMonth.value = new Date(currentMonth.value.getFullYear(), currentMonth.value.getMonth() - 1);
};

const nextMonth = () => {
  currentMonth.value = new Date(currentMonth.value.getFullYear(), currentMonth.value.getMonth() + 1);
};
</script>

<template>
  <div class="bg-white rounded-2xl p-6">
    <!-- Calendar Header -->
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-semibold text-gray-900">{{ monthYear }}</h3>
      <div class="flex space-x-2">
        <button @click="previousMonth" class="text-gray-400 hover:text-gray-600">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button @click="nextMonth" class="text-gray-400 hover:text-gray-600">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
    
    <!-- Week Days -->
    <div class="grid grid-cols-7 gap-2 mb-2">
      <div 
        v-for="day in weekDays" 
        :key="day"
        class="text-xs font-medium text-gray-500 text-center py-2"
      >
        {{ day }}
      </div>
    </div>
    
    <!-- Calendar Days -->
    <div class="grid grid-cols-7 gap-2">
      <button
        v-for="(date, index) in calendarDays"
        :key="index"
        @click="date && (selectedDate = date)"
        :class="[
          'aspect-square flex items-center justify-center text-sm rounded-lg transition-colors',
          date ? 'hover:bg-gray-100' : '',
          isToday(date) ? 'bg-gray-900 text-white hover:bg-gray-800' : '',
          isSelected(date) && !isToday(date) ? 'bg-purple-100 text-purple-600' : '',
          !date ? 'invisible' : 'text-gray-700'
        ]"
        :disabled="!date"
      >
        {{ date ? date.getDate() : '' }}
      </button>
    </div>
  </div>
</template>
