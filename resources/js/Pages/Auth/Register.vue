<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3'
import CardMobile from '@/Components/CardMobile.vue'
import InputFull from '@/Components/InputFull.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import { useLoginStore } from '@/stores/useLoginStore'


///// pinia ////
const storeRegister = useLoginStore()
const { showModalRegister } = storeRegister
////// pinia ////

const page = usePage()

const form = useForm({
    first_name: '',
    last_name: '',
    username: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register.store'), { onFinish: () => form.reset('password', 'password_confirmation'), onSuccess: () => { showModalRegister() }  })
}

</script>

<template>
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
<CardMobile>
    <form v-on:submit.prevent="submit" >

        <div class="flex justify-center items-center mb-5">
            <span class="w-11/12 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">Register</span>
            <div class="w-1/12 flex justify-end">
                <ButtonColor @click="showModalRegister()" text="white" bg="gray" class="">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </ButtonColor>
            </div>
        </div>
    
        <div class="xl:col-span-2 sm:col-span-1">
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                <div class="mx-2">
                    <InputFull
                        v-model:model="form.first_name"
                        v-model:errors="page.props.errors.first_name"
                        :label="$t('First Name')"
                        :type="'text'"
                        :id="'first_name'"
                        ref="first_name"
                        :autofocus="true"
                    />
                </div>
                <div class="mx-2">
                    <InputFull
                        v-model:model="form.last_name"
                        v-model:errors="page.props.errors.last_name"
                        :label="$t('Last Name')"
                        :type="'text'"
                        :id="'last_name'"
                        ref="last_name"
                    />
                </div>
            </div>
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                <div class="mx-2">
                <InputFull
                        v-model:model="form.username"
                        v-model:errors="page.props.errors.username"
                        :label="$t('User Name')"
                        :type="'text'"
                        :id="'username'"
                        ref="username"
                    />
                </div>
                <div class="mx-2">
                    <InputFull
                        v-model:model="form.phone"
                        v-model:errors="page.props.errors.phone"
                        :label="$t('Phone')"
                        :type="'text'"
                        :id="'phone'"
                        ref="phone"
                    />
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
                />
            </div>
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
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
                <div class="mx-2">
                    <InputFull
                        v-model:model="form.password_confirmation"
                        v-model:errors="page.props.errors.password"
                        :label="$t('Password Confirmation')"
                        :type="'password'"
                        :id="'password_confirmation'"
                        ref="password_confirmation"
                    />
                </div>
            </div>
            <div class="flex justify-between items-center gap-6 mt-3">
                <Link
                    :href="route('login.create')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <ButtonColor text="white" bg="green" type="submit" class="m-3 px-5 py-2.5">{{ $t('Create Register') }}</ButtonColor>
            </div>
        </div>
    </form>    
</CardMobile>
</div>
</template>
