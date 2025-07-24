<script setup>
import { usePage, useForm } from '@inertiajs/vue3'
import CardMobile from '@/Components/CardMobile.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import InputFull from '@/Components/InputFull.vue'
import { useLoginStore } from '@/stores/useLoginStore'

///// pinia ////
const storeForgot = useLoginStore()
const { showModalForgotPassword, showModalLogin } = storeForgot

defineProps({
    status: {
        type: String,
    },
})
const page = usePage()

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'), {
        onFinish: () => form.reset('email'),
        onSuccess: () => { showModalLogin(), showModalForgotPassword() }
    })
}
</script>

<template>
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
<CardMobile>

     <form @submit.prevent="submit" class="w-96">
        <div class="flex justify-center items-center mb-5">
            <span class="w-11/12 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">Forgot Password</span>
            <div class="w-1/12 flex justify-end">
                <ButtonColor @click="showModalForgotPassword()" text="white" bg="gray" class="">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </ButtonColor>
            </div>
        </div>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>
        <InputFull
            v-model:model="form.email"
            v-model:errors="page.props.errors.email"
            :label="$t('Email')"
            :type="'email'"
            :id="'email'"
            ref="email"
            :autofocus="true"
        />
        <div class="flex items-center justify-end mt-4">
            <ButtonColor text="white" bg="green" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Email Password Reset Link
            </ButtonColor>
        </div>
    </form>
</CardMobile>
</div>
</template>
