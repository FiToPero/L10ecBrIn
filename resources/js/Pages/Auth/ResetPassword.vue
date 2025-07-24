<script setup>
import { useLoginStore } from '@/stores/useLoginStore'
import { usePage, useForm } from '@inertiajs/vue3'
import CardMobile from '@/Components/CardMobile.vue'
import InputFull from '@/Components/InputFull.vue'
import ButtonColor from '@/Components/ButtonColor.vue'


///// pinia ////
const storeForgot = useLoginStore()
const { showModalResetPassword } = storeForgot

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
})

const page = usePage()

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<template>
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
<CardMobile>
    <form v-on:submit.prevent="submit" class="w-96">

        <div class="flex justify-center items-center mb-5">
            <span class="w-11/12 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">New Password</span>
            <div class="w-1/12 flex justify-end">
                <ButtonColor @click="showModalResetPassword()" text="white" bg="gray" class="">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </ButtonColor>
            </div>
        </div>
        <div>
            <InputFull
                v-model:model="form.password"
                v-model:errors="page.props.errors.password"
                :label="$t('Password')"
                :type="'password'"
                :id="'password'"
                ref="password"
            />
        </div>
            <div>
            <InputFull
                v-model:model="form.password_confirmation"
                v-model:errors="page.props.errors.password_confirmation"
                :label="$t('Password Confirmation')"
                :type="'password'"
                :id="'password_confirmation'"
                ref="password_confirmation"
            />
        </div>
        <div class="flex items-center justify-end mt-4">
            <ButtonColor text="white" bg="green" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="px-5 py-2.5">
                {{ $t('Reset Password') }}
            </ButtonColor>
        </div>
    </form>

    
</CardMobile>
</div>
</template>
