<script setup>
defineProps({
  schedules: {
    type: Array,
    required: true
  }
});
</script>

<template>
  <div class="bg-white rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Schedule</h3>
      <a href="#" class="text-sm text-gray-500 hover:text-gray-700">See all →</a>
    </div>
    
    <div class="space-y-3">
      <div 
        v-for="schedule in schedules" 
        :key="schedule.id"
        :class="[
          'flex items-center p-4 rounded-xl transition-colors cursor-pointer',
          schedule.highlighted ? 'bg-gray-900 text-white' : 'hover:bg-gray-50'
        ]"
      >
        <div class="flex-shrink-0 mr-4">
          <div :class="[
            'text-center',
            schedule.highlighted ? 'text-white' : 'text-gray-900'
          ]">
            <div class="text-2xl font-bold">{{ schedule.day }}</div>
          </div>
        </div>
        
        <div class="flex-1 min-w-0">
          <h4 :class="[
            'text-sm font-semibold mb-1',
            schedule.highlighted ? 'text-white' : 'text-gray-900'
          ]">
            {{ schedule.title }}
          </h4>
          <p :class="[
            'text-xs',
            schedule.highlighted ? 'text-gray-300' : 'text-gray-500'
          ]">
            {{ schedule.students }}
          </p>
        </div>
        
        <div class="flex-shrink-0 ml-4">
          <span :class="[
            'text-xs',
            schedule.highlighted ? 'text-gray-300' : 'text-gray-500'
          ]">
            {{ schedule.time }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
