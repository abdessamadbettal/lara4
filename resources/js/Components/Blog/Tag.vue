<template>
    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
      #{{ name }}
    </span>
  </template>

  <script setup>
  const props = defineProps({
    name: {
      type: String,
      required: true
    }
  });
  </script>
