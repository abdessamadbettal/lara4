<template>
    <li class="dropdown inline-block relative ps-1.5">
      <span class="relative dropdown-toggle align-middle inline-flex search-dropdown">
        <input type="checkbox" class="checkbox opacity-0 absolute" id="chk" v-model="isDarkMode" @change="changeMode">
        <label
          class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-800 cursor-pointer rounded-full flex justify-between items-center p-1 w-10 h-5"
          for="chk">
          <Moon class="w-[10px] h-[10px] text-yellow-500" />
          <Sun class="w-[10px] h-[10px] text-yellow-500" />
          <span
            class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[0px] left-[0px] w-5 h-5"
            :class="{ 'left-[20px]': isDarkMode }"></span>
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
