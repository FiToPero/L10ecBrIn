<script setup>
import { useForm, router, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import DropZone from "@/Components/DropZone.vue"

const props = defineProps({
    user: { type: Object },
    roles: { type: Array },
    errors: { type: Object }
})
const dropzoneFile = ref(props.user.profile_photo_path)

const receiveImageFile = (image) => {
    dropzoneFile.value = image
}
const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,    
    username: props.user.username,
    phone: props.user.phone,
    address: props.user.address,
    city: props.user.city,
    state: props.user.state,
    country: props.user.country,
    zip_code: props.user.zip_code,
    company: props.user.company,
    profile_photo_path: props.user.profile_photo_path,
    email: props.user.email,
    role_id: props.user.role_id,
 
})
const handleFileChange = (event) => {
  form.profile_photo_path = event.target.files[0]
  dropzoneFile.value = form.profile_photo_path.name
}
const submit = () => {
    console.log(form)
    form.put(route('adminUser.update', [props.user.id]))
}

const deleteStore = (id) => {
    router.delete(route('adminUser.delete', [id]), {}, {});
}


</script>
<template>
    <div class="w-screen h-screen p-6 font-sans text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100 antialiased">
<!--  -->
<form v-on:submit.prevent="submit">
<div class="p-4 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250"> 
    <div class="flex justify-center items-center mb-5">
        <span class="w-5/6 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">Edit User</span>
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
            <DropZone @imageFile="receiveImageFile" @change="handleFileChange" :imageEdit="form.profile_photo_path" :class="{'border border-red-500 dark:border-red-500' : errors.profile_photo_path}" @focus="errors.profile_photo_path = ''"/>
            <input class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full h-10 mt-5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-white' :class="{'border-red-500 dark:border-red-500' : errors.profile_photo_path}" @focus="errors.profile_photo_path = ''" :placeholder="dropzoneFile" disabled/>
            <p v-if="errors.profile_photo_path" class="text-red-500 text-sm font-bold flex">{{ errors.profile_photo_path }}</p>
        </div>
        <!-- Dropzone -->
        <div class="xl:col-span-2 sm:col-span-1">
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                <div class="mx-2">
                    <label for=first_name class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>First Name</label>
                    <input
                        v-model="form.first_name" 
                        type='text' 
                        id=first_name 
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.first_name}"
                        @focus="errors.first_name = ''"
                    />
                    <div v-if="errors.first_name" class="text-red-500 text-sm font-bold">{{ errors.first_name }}</div>
                </div>
                <div class="mx-2">
                    <label for=last_name class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Last Name</label>
                    <input
                        v-model="form.last_name" 
                        type='text' 
                        id=last_name 
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.last_name}"
                        @focus="errors.last_name = ''"
                    />
                    <div v-if="errors.last_name" class="text-red-500 text-sm font-bold">{{ errors.last_name }}</div>
                </div>
            </div>
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                <div class="mx-2">
                    <label for=username class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>User Name</label>
                    <input 
                        v-model="form.username"
                        type='text' 
                        id=username
                        disabled
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.username}"
                        @focus="errors.username = ''"
                    />
                    <div v-if="errors.username" class="text-red-500 text-sm font-bold">{{ errors.username }}</div>
                </div>
                <div class="mx-2">
                    <label for=phone class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Phone</label>
                    <input 
                        v-model="form.phone"
                        type='text' 
                        id=phone
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.phone}"
                        @focus="errors.phone = ''"
                    />
                    <div v-if="errors.phone" class="text-red-500 text-sm font-bold">{{ errors.phone }}</div>
                </div>
            </div>
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                <div class="mx-2">
                    <label for=address class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Address</label>
                    <input
                        v-model="form.address" 
                        type='text' 
                        id=address 
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.address}"
                        @focus="errors.address = ''"
                    />
                    <div v-if="errors.address" class="text-red-500 text-sm font-bold">{{ errors.address }}</div>
                </div>
                <div class="mx-2">
                    <label for=city class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>City</label>
                    <input
                        v-model="form.city" 
                        type='text' 
                        id=city 
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.city}"
                        @focus="errors.city = ''"
                    />
                    <div v-if="errors.city" class="text-red-500 text-sm font-bold">{{ errors.city }}</div>
                </div>
            </div>
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                <div class="mx-2">
                    <label for=state class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>State</label>
                    <input
                        v-model="form.state"
                        type='text' 
                        id=state
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.state}"
                        @focus="errors.state = ''"
                    />
                    <div v-if="errors.state" class="text-red-500 text-sm font-bold">{{ errors.state }}</div>
                </div>
                <div class="mx-2">
                    <label for=country class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Country</label>
                    <input
                        v-model="form.country"
                        type='text' 
                        id=country
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.country}"
                        @focus="errors.country = ''"
                    />
                    <div v-if="errors.country" class="text-red-500 text-sm font-bold">{{ errors.country }}</div>
                </div>
            </div>
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                <div class="mx-2">
                    <label for=zip_code class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Zip code</label>
                    <input
                        v-model="form.zip_code" 
                        type='text' 
                        id=zip_code 
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.zip_code}"
                        @focus="errors.zip_code = ''"
                    />
                    <div v-if="errors.zip_code" class="text-red-500 text-sm font-bold">{{ errors.zip_code }}</div>
                </div>
                <div class="mx-2">
                    <label for=company class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Company</label>
                    <input
                        v-model="form.company"
                        type='text'
                        id="company"
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.company}"
                        @focus="errors.company = ''"
                    />
                    <div v-if="errors.company" class="text-red-500 text-sm font-bold">{{ errors.company }}</div>
                </div>
            </div>
            <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                <div class="mx-2">
                    <label for=email class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Email</label>
                    <input
                        v-model="form.email" 
                        type='text' 
                        id=email 
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.email}"
                        @focus="errors.email = ''"
                    />
                    <div v-if="errors.email" class="text-red-500 text-sm font-bold">{{ errors.email }}</div>
                </div>
                <div class="mx-2">
                    <label for=role_id class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Type Role</label>
                    <select
                        v-model="form.role_id" 
                        id=role_id 
                        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        :class="{'border-red-500 dark:border-red-500' : errors.role_id}"
                        @focus="errors.role_id = ''"
                    >
                        <option value="" disabled selected>Select a role</option>        
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                    <div v-if="errors.role_id" class="text-red-500 text-sm font-bold">{{ errors.role_id }}</div>
                </div>
            </div>
            <div class="flex justify-end items-center gap-6 mt-3">
                <Link :href="route('adminUser.index')" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-800 dark:focus:ring-gray-900">{{ $t('Close') }}</Link>
                <button type="submit" class="m-3 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $t('Edit User') }}</button>
                <button type="button" @click="deleteStore(props.user.id)" class="my-5 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">{{ $t('Delete') }}</button>
            </div>
        </div>
    </div>
</div>
</form>
<!--  -->
    </div>
</template>