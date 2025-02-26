<!-- FILE: Components/MobileNav.vue -->
<template>
    <div class="md:hidden">
        <button class="p-2 md:hidden relative z-10" @click.prevent="toggleMobileMenu">
            <component :is="showMobileMenu ? IconX : IconBars" class="w-5"
                :class="{ 'text-red-500 dark:text-red-300': showMobileMenu }" />
        </button>

        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition-opacity duration-500">
            <div v-show="showMobileMenu" @click.prevent="toggleMobileMenu"
                class="fixed inset-0 bg-slate-200/50 dark:bg-slate-800/50 backdrop-blur-sm" />
        </Transition>

        <Transition enter-from-class="-translate-x-full opacity-0" leave-to-class="-translate-x-full opacity-0"
            class="transition-all duration-500">
            <div @click.stop v-show="showMobileMenu"
                class="p-4 absolute inset-x-4 top-14 bg-white dark:bg-slate-900 rounded-xl shadow-lg">
                <nav class="flex flex-col">
                    <button v-for="menu in menuItems" :key="menu.label" v-text="menu.label"
                        @click.prevent="redirect(menu.link)"
                        class="p-4 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-left" />
                    <hr class="my-2 border-slate-200 dark:border-slate-700" />
                    <Link class="p-4 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-left"
                        :href="route('login')" v-if="canLogin && !$page.props.auth.user">
                    Login
                    </Link>
                    <div class="flex flex-col gap-2" v-if="$page.props.auth.user">
                        <div class="py-6 px-4">
                            <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>
                        <Link :href="route('dashboard')"
                            class="p-4 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-left">
                        Dashboard
                        </Link>
                        <Link :href="route('profile.edit')"
                            class="p-4 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-left">
                        Profile
                        </Link>
                        <Link :href="route('logout')" method="post" as="button"
                            class="p-4 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-left">
                        Log Out
                        </Link>
                    </div>
                </nav>
            </div>
        </Transition>
    </div>
</template>

<script setup>
import { ref } from "vue"
import IconBars from "@/Components/Icons/IconBars.vue"
import IconX from "@/Components/Icons/IconX.vue"
import { Link } from '@inertiajs/vue3';
import Button from "../Button.vue";

const props = defineProps({
    menuItems: {
        type: Array,
        required: true,
    },
    canLogin: {
        type: Boolean,
    },
})

const showMobileMenu = ref(false)

function toggleMobileMenu() {
    showMobileMenu.value = !showMobileMenu.value
}

function redirect(link) {
    showMobileMenu.value = false
    window.location = link
}
</script>
