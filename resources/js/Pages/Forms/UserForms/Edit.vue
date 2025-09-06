<script setup>
import { useForm, usePage, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import DropZone from "@/Components/DropZone.vue"
import CardMobile from '@/Components/CardMobile.vue'
import InputFull from '@/Components/InputFull.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'


const props = defineProps({
    user: { type: Object },
    roles: { type: Array },
})
const page = usePage()

const form = useForm({
    id: props.user.id,
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
    role_id: props.user.role.id,
    role_name: props.user.role.name,
})
///// Image //////
const dropzoneFile = ref(props.user.profile_photo_path)
const receiveImageFile = (image) => { dropzoneFile.value = image }
const handleFileChange = (event) => {
  form.profile_photo_path = event.target.files[0]
  dropzoneFile.value = form.profile_photo_path.name
}
/////// form //////
const submit = () => {
    form.post(route('adminUser.update'), { onSuccess: () => {emit('closeEdit')} }
)}
const emit = defineEmits(['closeEdit'])

</script>
<template>
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
<CardMobile>
<div class="overflow-y-auto max-h-[80vh] hide-scrollbar" >
<form v-on:submit.prevent="submit">
    <div class="flex justify-center items-center m-5 ">
        <span class="w-5/6 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">Edit User</span>
        <div class="w-1/6 flex justify-end">
            <ButtonColor text="white" bg="gray" @click="emit('closeEdit')" >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </ButtonColor>
        </div>
    </div>
    <div class="grid xl:grid-cols-3 sm:grid-cols-1 ">
        <!-- DropZone -->
        <div class="mr-5">
            <DropZone @imageFile="receiveImageFile" @change="handleFileChange" :imageEdit="user.profile_photo_path" :class="{'border border-red-500 dark:border-red-500' : page.props.errors.profile_photo_path}" @focus="page.props.errors.profile_photo_path = ''"/>
            <InputFull
                    v-model:model="dropzoneFile"
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
                        :disabled="true"
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
                        :disabled="true"
                        :label="$t('Email')"
                        :type="'text'"
                        :id="'email'"
                        ref="email"
                    />
                </div>
                <div class="mx-2">
                    <template v-if="roles">
                        <label for=role_id class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Type Role</label>
                        <select
                            v-model="form.role_id" 
                            id=role_id 
                            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                            :class="{'border-red-500 dark:border-red-500' : page.props.errors.role_id}"
                            @focus="page.props.errors.role_id = ''"
                        >
                            <option value="" disabled >Select a role</option>        
                            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                        </select>
                        <div v-if="page.props.errors.role_id" class="text-red-500 text-sm font-bold">{{ page.props.errors.role_id }}</div>
                    </template>
                    <template v-else>
                        <InputFull
                            v-model:model="form.role_name"
                            v-model:errors="page.props.errors.role"
                            :label="$t('Role')"
                            :disabled="true"
                            :type="'text'"
                            :id="'role_id'"
                            ref="role_id"
                        />
                    </template>
                </div>
            </div>
            <div class="flex justify-end items-center gap-6 mt-3">
                <ButtonColor text="white" bg="gray" @click="emit('closeEdit')" >{{ $t('Close') }}</ButtonColor>
                <button type="submit" class="m-3 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $t('Edit User') }}</button>
            </div>
        </div>
    </div>
</form>


<div class="p-4 my-5 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <UpdatePasswordForm class="max-w-xl" />
</div>

<div class="p-4 my-5 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <DeleteUserForm class="max-w-xl" />
</div>


</div>
</CardMobile>
</div>
</template>

<style scoped>
.hide-scrollbar {
  scrollbar-width: none; /* Firefox */
}
.hide-scrollbar::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Edge */
}
</style>