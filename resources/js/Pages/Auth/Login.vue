<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import { usePage, Link, useForm } from '@inertiajs/vue3'
import CardMobile from '@/Components/CardMobile.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import InputFull from '@/Components/InputFull.vue'
import { useLoginStore } from '@/stores/useLoginStore'

///// pinia ////
const storeLogin = useLoginStore()
const { showModalLogin } = storeLogin
////// pinia ////

const page = usePage()

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login.store'), { onFinish: () => form.reset('password'), onSuccess: () => { showModalLogin() } })
}
</script>

<template>
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
<CardMobile>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>
        
        <form @submit.prevent="submit">
            <div class="flex justify-center items-center mb-5">
            <span class="w-11/12 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">Login</span>
            <div class="w-1/12 flex justify-end">
                <ButtonColor @click="showModalLogin()" text="white" bg="gray" class="">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </ButtonColor>
            </div>
        </div>
        <div class="mx-2">
            <InputFull
                v-model:model="form.email"
                v-model:errors="page.props.errors.email"
                :label="$t('Email')"
                :type="'text'"
                :id="'email'"
                ref="email"
                :autofocus="true"
            />
        </div>
        <div class="mx-2">
        <InputFull
                v-model:model="form.password"
                v-model:errors="page.props.errors.password"
                :label="$t('Password')"
                :type="'password'"
                :id="'password'"
                ref="password"
            />
        </div>
        <div class="mt-4 block">
            <label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" />
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                    >Remember me</span
                >
            </label>
        </div>
        <div class="mt-4 flex items-center justify-end">
            <Link
                v-if="canResetPassword"
                :href="route('password.request')"
                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
            >
                Forgot your password?
            </Link>

            <ButtonColor
                text="white" bg="green"
                class="ms-4 px-5 py-2.5"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Log in
            </ButtonColor>
        </div>
        </form>


</CardMobile>
</div>
</template>
