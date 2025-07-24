<script setup>
import { computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import CardMobile from '@/Components/CardMobile.vue'
import { Head, Link, useForm, router } from '@inertiajs/vue3'

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
)
const returnWelcome = () => {
    router.get(route('welcome.index'))
};
</script>

<template>
<AuthenticatedLayout>
        <Head title="Email Verification" />

<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
<CardMobile>   
      
<div>
    <div class="flex justify-center items-center mb-5">
        <span class="w-11/12 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">{{ $t('Verification Email') }}</span>
        <div class="w-1/12 flex justify-end">
            <ButtonColor @click="returnWelcome()" text="white" bg="gray" class="">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </ButtonColor>
        </div>
    </div>

    <form @submit.prevent="submit">  
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Thanks for signing up! Before getting started, could you verify your
            email address by clicking on the link we just emailed to you? If you
            didn't receive the email, we will gladly send you another.
        </div>

        <div
            class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
            v-if="verificationLinkSent"
        >
            A new verification link has been sent to the email address you
            provided during registration.
        </div>

        
        <div class="mt-4 flex items-center justify-between">
            <ButtonColor @click="submit" text="white" bg="blue" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="px-5 py-2.5" >
                Resend Verification Email
            </ButtonColor>

            <Link
                :href="route('logout')"
                method="post"
                as="button"
                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >Log Out</Link
            >
        </div>
    </form>
</div>

</CardMobile>
</div>
</AuthenticatedLayout>
</template>
