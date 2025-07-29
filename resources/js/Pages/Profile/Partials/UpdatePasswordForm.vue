<script setup>

import InputFull from '@/Components/InputFull.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage()

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
})

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (page.props.errors.password) {
                form.reset('password', 'password_confirmation')
            }
            if (page.props.errors.current_password) {
                form.reset('current_password')
            }
        },
    })
}
</script>

<template>
    <div class="">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $t('Update Password') }}</h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ $t('Ensure your account is using a long, random password to stay secure.') }}
        </p>


        <form @submit.prevent="updatePassword">
            <InputFull
                v-model:model="form.current_password"
                v-model:errors="page.props.errors.current_password"
                :label="$t('Current Password')"
                :type="'password'"
                :id="'current_password'"
            />
            <InputFull
                v-model:model="form.password"
                v-model:errors="page.props.errors.password"
                :label="$t('Password')"
                :type="'password'"
                :id="'password'"
            />
            <InputFull
                v-model:model="form.password_confirmation"
                v-model:errors="page.props.errors.password_confirmation"
                :label="$t('Password Confirmation')"
                :type="'password'"
                :id="'password_confirmation'"
            />
            <div class="flex items-center gap-4 mt-5">
                <ButtonColor text="white" bg="cyan" :disabled="form.processing">{{ $t('Save') }}</ButtonColor>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">{{ $t('Saved.') }}</p>
                </Transition>
            </div>
        </form>
    </div>
</template>
