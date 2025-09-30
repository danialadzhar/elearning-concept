<script setup>
import { computed } from 'vue';

const props = defineProps({
  data: {
    type: Array,
    required: true
  }
});

// Calculate maximum value untuk scaling
const maxValue = computed(() => Math.max(...props.data.map(d => d.hours)));

const getBarHeight = (hours) => {
  return (hours / maxValue.value) * 100;
};
</script>

<template>
  <div class="bg-white rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Hours spend</h3>
      <span class="text-sm text-gray-500">20 hr/wk</span>
    </div>
    
    <!-- Bar Chart -->
    <div class="flex items-end justify-between h-32 space-x-2">
      <div 
        v-for="item in data" 
        :key="item.day"
        class="flex-1 flex flex-col items-center"
      >
        <!-- Bar -->
        <div class="w-full flex items-end justify-center mb-2" style="height: 120px;">
          <div 
            :class="[
              'w-full rounded-t-lg transition-all duration-300',
              item.highlighted ? 'bg-purple-500' : 'bg-gray-200'
            ]"
            :style="{ height: `${getBarHeight(item.hours)}%` }"
          ></div>
        </div>
        
        <!-- Day Label -->
        <span class="text-xs text-gray-500 font-medium">{{ item.day }}</span>
      </div>
    </div>
  </div>
</template>
