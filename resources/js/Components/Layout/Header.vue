<script setup>
import { ref } from "vue"
import Container from "@/Components/Container.vue"
import Logo from "@/Components/Icons/Logo.vue"
import IconBars from "@/Components/Icons/IconBars.vue"
import IconX from "@/Components/Icons/IconX.vue"
import Button from "@/Components/Button.vue"
import { Transition } from "vue"
import { Link } from '@inertiajs/vue3';
import Dropdown from '@/Components/Forms/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import LanguageSwitcher from "@/Components/LanguageSwitcher.vue";
import MobileNav from "@/Components/Layout/MobileNav.vue"

const props = defineProps({
    menuItems: {
        type: Array,
        required: true,
        default: () => []
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
})

const showMobileMenu = ref(false)

function redirect(link) {
    showMobileMenu.value = false
    window.location = link
}
</script>

<template>
    <header class="py-6 md:py-10 sticky top-0 z-10 ">
        <Container class="relative flex items-center justify-between gap-4 text-slate-600 dark:text-slate-300 text-sm">
            <div class="flex items-center gap-8">
                <Link :href="route('welcome')">
                <Logo class="h-10" />
                </Link>
                <nav class="items-center gap-3 hidden md:flex">
                    <a v-for="menu in menuItems" :key="menu.label" v-text="menu.label" :href="menu.link"
                        class="rounded-lg py-1.5 px-3 transition-colors duration-300 hover:bg-red-200 dark:hover:bg-red-800 font-bold text-red-900 dark:text-red-300 hover:bg-opacity-30" />
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <ThemeSwitcher />
                <LanguageSwitcher />
                <div class="hidden sm:ms-6 sm:flex sm:items-center" v-if="$page.props.auth.user">
                    <!-- Settings Dropdown -->
                    <div class="relative ms-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                        {{ $page.props.auth.user.name }}

                                        <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('dashboard')" >
                                Dashboard
                                </DropdownLink>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <template v-else>
                    <Button variant="outline" :href="route('login')" class="hidden md:inline" v-if="!route().current('login')">
                        Login
                    </Button>

                    <Button :href="route('register')" v-if="canRegister && !route().current('register')">
                        Register <span v-text="'now'" class="hidden lg:inline pl-1" />
                    </Button>
                </template>

                <!-- MOBILE MENU -->
                <MobileNav :menuItems="menuItems" :canLogin="canLogin" />

            </div>
        </Container>
    </header>
</template>
