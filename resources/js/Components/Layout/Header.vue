<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue"
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

const isRegisterRoute = computed(() => {
    return route().current('register')
})

const showMobileMenu = ref(false)
const scrollY = ref(0)

function redirect(link) {
    showMobileMenu.value = false
    window.location = link
}

const handleScroll = () => {
    scrollY.value = window.scrollY
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})

const headerClass = computed(() => {
    return scrollY.value > 100 ? 'bg-white dark:bg-gray-800 bg-opacity-75 dark:bg-opacity-75' : ''
})
</script>

<template>
    <header :class="headerClass" class=" py-4 w-full md:py-4 sticky top-0 z-10 transition-colors duration-300">
        <Container class="relative flex items-center justify-between gap-4 text-slate-600 dark:text-slate-300 text-sm">
            <div class="flex items-center gap-8">
                <Link :href="route('welcome')">
                <Logo class="h-10" />
                </Link>
                <nav class="items-center gap-3 hidden md:flex">
                    <a v-for="menu in menuItems" :key="menu.label" :href="menu.link"
                        class="rounded-lg py-1.5 px-3 transition-colors duration-300 hover:bg-red-200 dark:hover:bg-red-800 font-bold text-red-900 dark:text-red-300 hover:bg-opacity-30">
                        {{ $t(menu.label) }}
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-2">
                <ThemeSwitcher />
                <LanguageSwitcher :locales="$page.props.locales"
                :currentLocale="$page.props.currentLocale"/>
                <div class="hidden sm:flex sm:items-center" v-if="$page.props.auth.user">
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
                                    {{ $t('auth.dashboard') }}
                                </DropdownLink>
                                <DropdownLink :href="route('profile.edit')">
                                    {{ $t('auth.profile') }}
                                </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    {{ $t('auth.logout') }}
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <template v-else>
                    <Button variant="outline" :href="route('login')" class="hidden md:inline" v-if="route().current('register')">
                        {{ $t('auth.login') }}
                    </Button>

                    <Button :href="route('register')" v-if="!route().current('register')">
                        {{ $t('auth.register') }} <span v-text="'now'" class="hidden lg:inline pl-1" />
                    </Button>
                </template>

                <!-- MOBILE MENU -->
                <MobileNav :menuItems="menuItems" :canLogin="canLogin" />

            </div>
        </Container>
    </header>
</template>
