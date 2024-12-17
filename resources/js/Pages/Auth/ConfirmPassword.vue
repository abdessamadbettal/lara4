<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/Forms/InputError.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import Button from '@/Components/Button.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GeneralLayout>
        <GuestLayout>
            <Head title="Confirm Password" />

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                This is a secure area of the application. Please confirm your
                password before continuing.
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4 flex justify-end">
                    <Button
                        class="ms-4"
                        :isLoading="form.processing"
                    >
                        Confirm
                    </Button>
                </div>
            </form>
        </GuestLayout>
    </GeneralLayout>
</template>
