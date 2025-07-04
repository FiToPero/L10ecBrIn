<script setup>
import { useForm, usePage, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import DropZone from "@/Components/DropZone.vue"
import CardMobile from "@/Components/CardMobile.vue"
import InputFull from "@/Components/InputFull.vue"


const props = defineProps({
    // page.props.errors: {type: Object},
    roles: {type: Array}
})
const page = usePage()
const dropzoneFile = ref("")

const form = useForm({
    first_name: '',
    last_name: '',
    username: '',
    phone: '',
    address: '',
    city: '',
    state: '',
    country: '',
    zip_code: '',
    company: '',
    profile_photo_path: '',
    email: '',
    password: '',
    password_confirmation: '',
    role_id: ''
})
const receiveImageFile = (image) => {
    dropzoneFile.value = image
}
const handleFileChange = (event) => {
  form.profile_photo_path = event.target.files[0]
  dropzoneFile.value = form.profile_photo_path.name
}
const submit = () => {
    form.post(route('adminUser.store'))
}
const emit = defineEmits(['closeCreate'])
</script>

<template>
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
<CardMobile>

    <form v-on:submit.prevent="submit" >

        <div class="flex justify-center items-center mb-5">
            <span class="w-5/6 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">Create New User</span>
            <div class="w-1/6 flex justify-end">
                <Link :href="route('adminUser.index')" type="button" class="text-gray-600 dark:text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:bg-gray-600">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </Link>
            </div>
        </div>
        <div class="grid xl:grid-cols-3 sm:grid-cols-1 ">
            <!-- DropZone -->
            <div class="mr-5">
                <DropZone @imageFile="receiveImageFile" @change="handleFileChange" :class="{'border border-red-500 dark:border-red-500' : page.props.errors.profile_photo_path}" @focus="page.props.errors.profile_photo_path = ''"/>
                <InputFull
                    v-model:model="form.profile_photo_path.name"
                    v-model:errors="page.props.errors.profile_photo_path"
                    :label="$t('Profile Photo')"
                    :type="'text'"
                    :id="'profile_photo_path'"
                    ref="profile_photo_path"
                />
            </div>
            <!-- Dropzone -->
            <div class="xl:col-span-2 sm:col-span-1">
                <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                    <div class="mx-2">
                        <InputFull
                            v-model:model="form.first_name"
                            v-model:errors="page.props.errors.first_name"
                            :label="$t('First Name')"
                            :type="'text'"
                            :id="'first_name'"
                            ref="input"
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
                            ref="input"
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
                <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                    <div class="mx-2">
                        <InputFull
                            v-model:model="form.address"
                            v-model:errors="page.props.errors.address"
                            :label="$t('Address')"
                            :type="'text'"
                            :id="'address'"
                            ref="address"
                        />
                    </div>
                    <div class="mx-2">
                        <InputFull
                            v-model:model="form.city"
                            v-model:errors="page.props.errors.city"
                            :label="$t('City')"
                            :type="'text'"
                            :id="'city'"
                            ref="city"
                        />
                    </div>
                </div>
                <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                    <div class="mx-2">
                        <InputFull
                            v-model:model="form.state"
                            v-model:errors="page.props.errors.state"
                            :label="$t('State')"
                            :type="'text'"
                            :id="'state'"
                            ref="state"
                        />
                    </div>
                    <div class="mx-2">
                        <InputFull
                            v-model:model="form.country"
                            v-model:errors="page.props.errors.country"
                            :label="$t('Country')"
                            :type="'text'"
                            :id="'country'"
                            ref="country"
                        />
                    </div>
                </div>
                <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                    <div class="mx-2">
                        <InputFull
                            v-model:model="form.zip_code"
                            v-model:errors="page.props.errors.zip_code"
                            :label="$t('Zip Code')"
                            :type="'text'"
                            :id="'zip_code'"
                            ref="zip_code"
                        />
                    </div>
                    <div class="mx-2">
                        <InputFull
                            v-model:model="form.company"
                            v-model:errors="page.props.errors.company"
                            :label="$t('Company')"
                            :type="'text'"
                            :id="'company'"
                            ref="company"
                        />
                    </div>
                </div>
                <div class="grid xl:grid-cols-2 sm:grid-cols-1">
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
                    <div class="mx-2">
                        <label for=role_id class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Type Role</label>
                        <select
                            v-model="form.role_id" 
                            id=role_id 
                            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                            :class="{'border-red-500 dark:border-red-500' : page.props.errors.role_id}"
                            @focus="page.props.errors.role_id = ''"
                        >
                            <option value="" disabled selected >Select a role</option>        
                            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                        </select>
                        <div v-if="page.props.errors.role_id" class="text-red-500 text-sm font-bold">{{ page.props.errors.role_id }}</div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-6 mt-3">
                    <Link :href="route('adminUser.index')" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-800 dark:focus:ring-gray-900">{{ $t('Close') }}</Link>
                    <button type="submit" class="m-3 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $t('Create New User') }}</button>
                </div>
            </div>
        </div>
    </form>

</CardMobile>
</div>
</template>

