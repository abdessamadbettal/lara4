<script setup>
import { ref, onMounted } from 'vue'
import { Moon, Sun } from 'lucide-vue-next'

const isDarkMode = ref(false)
const isTransitioning = ref(false)

const changeMode = () => {
  isTransitioning.value = true
  isDarkMode.value = !isDarkMode.value
  
  // Add transition class to body
  document.documentElement.classList.add('theme-transitioning')
  
  // Toggle dark mode
  document.documentElement.classList.toggle('dark', isDarkMode.value)
  localStorage.setItem('theme', isDarkMode.value ? 'dark' : 'light')
  
  // Remove transition class after animation
  setTimeout(() => {
    document.documentElement.classList.remove('theme-transitioning')
    isTransitioning.value = false
  }, 200)
}

onMounted(() => {
  // Check system preference first
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
  const savedTheme = localStorage.getItem('theme')
  
  // Use saved theme or system preference
  isDarkMode.value = savedTheme ? savedTheme === 'dark' : prefersDark
  document.documentElement.classList.toggle('dark', isDarkMode.value)
})
</script>

<template>
  <button
    @click="changeMode"
    class="relative inline-flex items-center justify-center w-10 h-10 rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-gray-800"
    :class="{ 'pointer-events-none': isTransitioning }"
    :aria-label="isDarkMode ? 'Switch to light mode' : 'Switch to dark mode'"
  >
    <div class="relative w-5 h-5">
      <!-- Sun Icon -->
      <Sun
        class="absolute inset-0 w-full h-full transition-all duration-300 text-yellow-500"
        :class="isDarkMode ? 'scale-0 rotate-90 opacity-0' : 'scale-100 rotate-0 opacity-100'"
      />
      <!-- Moon Icon -->
      <Moon
        class="absolute inset-0 w-full h-full transition-all duration-300 text-yellow-500"
        :class="isDarkMode ? 'scale-100 rotate-0 opacity-100' : 'scale-0 -rotate-90 opacity-0'"
      />
    </div>
    
    <!-- Tooltip -->
    <span 
      class="absolute bottom-full mb-2 px-2 py-1 text-xs font-medium text-white bg-gray-900 dark:bg-gray-700 rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity"
    >
      {{ isDarkMode ? 'Light Mode' : 'Dark Mode' }}
    </span>
  </button>
</template>

<style scoped>
/* Theme transition styles */
:root.theme-transitioning * {
  transition-duration: 200ms;
  transition-property: background-color, border-color, color, fill, stroke;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Prevent animation on page load */
.transition-all {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Hover effect */
button:hover .absolute {
  transform: scale(1.1);
}

/* Focus styles */
button:focus-visible {
  outline: 2px solid #FF2D20;
  outline-offset: 2px;
}
</style>