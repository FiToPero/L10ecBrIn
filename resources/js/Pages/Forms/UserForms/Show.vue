<script setup>
import { ref } from 'vue'
import { defineProps, defineEmits } from 'vue'

const close = ref(true)

const props = defineProps({
    user: {type: Object},
    roles: {type: Array}
})

const emit = defineEmits(['closeShow'])

const closeShow = () => {
    close.value = false
    emit('closeShow', close.value)
}

</script>

<template>
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
  
    <!--  -->
<div tabindex="0" @click.stop class="sm:col-span-1 max-w-7xl p-6 bg-white dark:bg-gray-800 dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none">
    <div class="flex justify-center">
        <span class="text-white dark:text-gray-300 text-3xl font-bold mb-10">Show User</span>
        <button @click="closeShow" type="button" class="text-gray-600 dark:text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:bg-gray-600">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    <div class="flex">
        <div class="w-1/3">
            <img v-if="user.profile_photo_path" class="object-cover w-full rounded-lg" :src="`/${user.profile_photo_path}`"  >
            <div v-else class="flex items-center justify-center w-full h-48 bg-gray-600 rounded-lg">
                <span class="text-gray-200">No Image</span>
            </div>
        </div>
        <div class=w-2/3>
            <div class="ml-4">
                <input type="hidden" name="id_user" class=""  :placeholder="user.id" disabled/>
                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="userName" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="user.first_name" disabled/> 
                </div>
                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="shortDescription" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" :placeholder="user.last_name" disabled/>
                </div>
                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="company" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="user.username" disabled/>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="stock" class="block py-2.5 px-0 w-full text-sm text-center placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" :placeholder="user.phone" disabled/>
                    </div>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="price" class="block py-2.5 px-0 w-full text-sm text-center placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" :placeholder=user.address disabled/>
                    </div>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="priority" class="block py-2.5 px-0 w-full text-sm text-center placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="user.city" disabled/>
                    </div>
                </div>
                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="brand" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="user.state" disabled/>
                </div>
                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="address" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="user.country" disabled/>
                </div>
                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="website" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="user.zip_code" disabled/>
                </div>
                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="email" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="user.email" disabled/>
                </div>
                <div class="relative z-0 w-full mb-2 group">
                    <input type="text" name="role_id" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="user.role_id" disabled/>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end gap-6">
        <button v-on:click="closeShow" class="my-5 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 ">{{ $t('Close') }}</button>
    </div>
</div> 
    <!--  -->
    </div>

</template>

