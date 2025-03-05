<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue"
import Container from "@/Components/Container.vue"
import Logo from "@/Components/Icons/Logo.vue"
import IconBars from "@/Components/Icons/IconBars.vue"
import IconX from "@/Components/Icons/IconX.vue"
import Button from "@/Components/Button.vue"
import { Transition } from "vue"
import { Link, usePage } from '@inertiajs/vue3'
import Dropdown from '@/Components/Forms/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue"
import LanguageSwitcher from "@/Components/LanguageSwitcher.vue"
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

const user = computed(() => usePage().props.auth.user.data)
const isAdmin = computed(() => user.value.isAdmin)
const showMobileMenu = ref(false)
const isHeaderVisible = ref(true)
const lastScrollPosition = ref(0)

// Enhanced scroll handling
onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})

const handleScroll = () => {
    const currentScrollPosition = window.scrollY

    // Show/hide header based on scroll direction
    if (currentScrollPosition < lastScrollPosition.value || currentScrollPosition < 50) {
        isHeaderVisible.value = true
    } else {
        isHeaderVisible.value = false
    }

    lastScrollPosition.value = currentScrollPosition
}

const avatarSize = computed(() => {
    // Use CSS classes instead, but this is here for demonstration
    return window.innerWidth < 640 ? 'w-6 h-6' : 'w-7 h-7'
})

// Add smooth transition when showing/hiding header
const headerClass = computed(() => [
    'fixed w-full transition-all duration-300 z-10',
    {
        'bg-white/90 dark:bg-gray-900/95 backdrop-blur-md shadow-md translate-y-0': lastScrollPosition.value > 50,
        'bg-transparent -translate-y-full': !isHeaderVisible.value,
        'translate-y-0': isHeaderVisible.value
    }
])
</script>

<template>
    <header :class="headerClass">
        <Container class="relative flex items-center justify-between gap-4 py-3">
            <!-- Logo and Navigation -->
            <div class="flex items-center gap-8">
                <Link :href="route('welcome')" class="transition-transform hover:scale-105 duration-200">
                <Logo class="h-10 sm:h-8 md:h-10" />
                </Link>

                <nav class="items-center gap-4 hidden md:flex">
                    <Link v-for="menu in menuItems" :key="menu.label" :href="menu.link"
                        class="relative rounded-lg py-1.5 px-3 transition-all duration-300 hover:bg-red-100 dark:hover:bg-red-800/30 font-medium text-gray-700 dark:text-gray-200 group">
                    <span class="relative z-10">{{ $t(menu.label) }}</span>
                    <span
                        class="absolute inset-0 rounded-lg bg-red-100 dark:bg-red-800/30 transform scale-0 transition-transform duration-300 group-hover:scale-100" />
                    <span
                        class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1/2 h-0.5 bg-red-500 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100" />
                    </Link>
                </nav>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center gap-3 md:gap-4">
                <ThemeSwitcher class="transition-transform hover:scale-110" />
                <LanguageSwitcher :locales="$page.props.locales" :currentLocale="$page.props.currentLocale"
                    class="transition-transform hover:scale-110" />

                <!-- User Menu -->
                <div class="hidden sm:flex sm:items-center" v-if="$page.props.auth.user">
                    <div class="relative ms-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button type="button"
                                    class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white/90 px-3 py-1.5 text-sm font-medium text-gray-700 transition duration-200 ease-in-out hover:bg-gray-50 hover:border-red-200 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-gray-800/90 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700/90 dark:hover:border-red-800/50">
                                    <img class="w-7 h-7 rounded-full ring-2 ring-white dark:ring-gray-700"
                                        :src="$page.props.auth.user.data.avatar" :alt="$page.props.auth.user.data.name">
                                    <span class="font-medium">{{ $page.props.auth.user.data.name }}</span>
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </template>

                            <template #content>
                                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Signed in as</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{
                                        $page.props.auth.user.data.email }}</p>
                                </div>

                                <template v-if="isAdmin">
                                    <DropdownLink href="/admin" as="a" class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Admin Panel
                                    </DropdownLink>
                                    <DropdownLink href="/logs" >
                                        Logs
                                    </DropdownLink>
                                </template>
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

                <!-- Auth Buttons -->
                <template v-else>
                    <Button variant="outline" :href="route('login')" method="get"
                        class="hidden md:inline-flex hover:scale-105 transition-transform"
                        v-if="route().current('register')">
                        {{ $t('auth.login') }}
                    </Button>

                    <Button :href="route('register')" v-if="!route().current('register')" method="get"
                        class="hidden md:inline-flex hover:scale-105 transition-transform">
                        {{ $t('auth.register') }}
                        <span class="hidden lg:inline-block ml-1 opacity-75">→</span>
                    </Button>
                </template>

                <MobileNav :menuItems="menuItems" :canLogin="canLogin" />
            </div>
        </Container>
    </header>
</template>

<style scoped>
.router-link-active {
    @apply bg-red-100 dark:bg-red-800/30 relative;
}

.router-link-active::after {
    content: '';
    @apply absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-red-500;
}

/* Add subtle bounce effect to hover transitions */
@keyframes subtleBounce {

    0%,
    100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.05);
    }
}

.hover\:scale-105:hover,
.hover\:scale-110:hover {
    animation: subtleBounce 0.3s ease;
}
</style>