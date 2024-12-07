<template>
    <li class="dropdown inline-block relative ps-1.5">
      <span class="relative dropdown-toggle align-middle inline-flex search-dropdown">
        <input type="checkbox" class="checkbox opacity-0 absolute" id="chk" v-model="isDarkMode" @change="changeMode">
        <label
          class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-800 cursor-pointer rounded-full flex justify-between items-center p-1 w-12 h-6"
          for="chk">
          <Moon class="w-[15px] h-[15px] text-yellow-500" />
          <Sun class="w-[15px] h-[15px] text-yellow-500" />
          <span
            class="ball bg-white dark:bg-slate-900 rounded-full absolute top-0.5  w-5 h-5"
            :class="{ isDarkMode, 'left-0.5': !isDarkMode, 'right-0.5': isDarkMode

            }"></span>
        </label>
      </span>
    </li>
  </template>

  <script>
  import { ref, onMounted } from 'vue';
  import { Moon, Sun } from 'lucide-vue-next';

  export default {
    name: 'ThemeModeSwitcher',
    components: {
      Moon,
      Sun,
    },
    setup() {
      const isDarkMode = ref(false);

      const changeMode = () => {
        const htmlTag = document.documentElement;
        htmlTag.classList.toggle('dark', isDarkMode.value);
        localStorage.setItem('theme', isDarkMode.value ? 'dark' : 'light');
      };

      onMounted(() => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
          isDarkMode.value = savedTheme === 'dark';
          document.documentElement.classList.toggle('dark', isDarkMode.value);
        }
      });

      return {
        isDarkMode,
        changeMode,
      };
    },
  };
  </script>
