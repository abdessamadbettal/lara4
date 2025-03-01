<template>
    <footer class="py-14 text-slate-500  dark:text-slate-400">
      <Container class="flex flex-col gap-10">
        <div class="flex flex-col items-center gap-6">
          <Link :href="route('welcome')">
            <Logo class="h-10" />
          </Link>
          <nav class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <Link
              v-for="menu in menuItems"
              :key="menu.label"
              :href="menu.link"
              class="rounded-lg py-1.5 px-3 transition-colors duration-300 hover:bg-slate-100 dark:hover:bg-slate-800"
            >
            {{ $t(menu.label) }}
            </Link>
          </nav>
        </div>
        <hr class="border-slate-200 dark:border-slate-700" />
        <div class="flex items-center text-center justify-between flex-col sm:flex-row gap-4">
          <p v-text="'Copyright © 2023 Lara4. All rights reserved.'" />
          <div class="flex items-center gap-4">
            <a
              href="https://github.com/abdessamadbettal/Lara4"
              target="_blank"
              class="hover:text-slate-900 dark:hover:text-slate-300 p-2 transition-colors duration-300"
            >
              <IconGithub class="w-5" />
            </a>
          </div>
        </div>
      </Container>
      <p class="py-3 text-center text-gray-600 dark:text-white/70 text-xs">
        Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
      </p>
    </footer>
  </template>

  <script setup>
  import Container from "@/Components/Container.vue";
  import Logo from "@/Components/Icons/Logo.vue";
  import IconGithub from "@/Components/Icons/IconGithub.vue";
  import { Link } from '@inertiajs/vue3';


  const props = defineProps({
    menuItems: Array,
    laravelVersion: String,
    phpVersion: String,
  });
  </script>
