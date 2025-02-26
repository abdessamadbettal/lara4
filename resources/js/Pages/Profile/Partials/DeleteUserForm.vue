<script setup>
import Button from '@/Components/Button.vue';
import InputError from '@/Components/Forms/InputError.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';


const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $t('auth.delete_account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ $t('auth.delete_account_warning') }}
            </p>
        </header>

        <Button @click="confirmUserDeletion" variant="danger">
            {{ $t('auth.delete_account') }}
        </Button>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ $t('auth.delete_account_confirmation') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $t('auth.delete_account_password_confirmation') }}
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        :value="$t('auth.password')"
                        class="sr-only"
                    />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        :placeholder="$t('auth.password')"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <Button @click="closeModal" variant="outline">
                        {{ $t('auth.cancel') }}
                    </Button>

                    <Button
                        class="ms-3"
                        variant="danger"
                        :isLoading="form.processing"
                        @click="deleteUser"
                    >
                        {{ $t('auth.delete_account') }}
                    </Button>
                </div>
            </div>
        </Modal>
    </section>
</template>
