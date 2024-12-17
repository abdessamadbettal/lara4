<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/Forms/InputError.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import Button from '@/Components/Button.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';


defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GeneralLayout>
        <GuestLayout>
            <Head :title="$t('auth.forgot_password')" />

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ $t('auth.forgot_password_message') }}
            </div>

            <div
                v-if="status"
                class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" :value="$t('auth.email')" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <Button
                        :isLoading="form.processing"
                    >
                        {{ $t('auth.email_password_reset_link') }}
                    </Button>
                </div>
            </form>
        </GuestLayout>
    </GeneralLayout>
</template>
