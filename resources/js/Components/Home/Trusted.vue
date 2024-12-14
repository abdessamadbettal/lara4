<script setup>
import { ref } from 'vue';
import Button from '@/Components/Button.vue';

const partners = ref([
    { name: "Laravel", src: "/assets/images/partners/laravel.svg" },
    { name: "Mirage", src: "/assets/images/partners/mirage.svg" },
    { name: "Statamic", src: "/assets/images/partners/statamic.svg" },
    { name: "Statickit", src: "/assets/images/partners/statickit.svg" },
    // { name: "Transistor", src: "/assets/images/partners/transistor.svg" },
    { name: "Inertia", src: "/assets/images/partners/inertia.svg" },
    { name: "Tuple", src: "/assets/images/partners/tuple.svg" },
    // { name: "Filament", src: "/assets/images/partners/filament.svg" },
])

const props = defineProps({
    id: {
        type: String,
        default: 'trusted'
    }
});
</script>

<template>
    <div class="space-y-6 text-center" :id="id">
        <p class="font-display">Trusted by these six companies so far</p>
        <div class="flex items-center justify-center gap-10 sm:gap-14 flex-wrap">
            <img loading="lazy" v-for="partner in partners" :src="partner.src" :alt="partner.name" class="h-10 sm:h-12"
                :key="partner.name" />
        </div>
    </div>
</template>
