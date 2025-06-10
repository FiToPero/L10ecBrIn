<script setup>
import { useForm, router, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import DropZone from "@/Components/DropZone.vue"

const props = defineProps({
    errors: {type: Object},
    product: {type: Object}
})

const dropzoneFile = ref(props.product.image_01)

const receiveImageFile = (image) => {
    dropzoneFile.value = image
}
const form = useForm({
    productName: props.product.productName,
    shortDescription: props.product.shortDescription,
    company: props.product.company,
    brand: props.product.brand,
    price: props.product.price,
    stock: props.product.stock,
    address: props.product.address,
    website: props.product.website,
    email: props.product.email,
    priority: props.product.priority,
    remember: props.product.remember,
    image_01: props.product.image_01
})
const handleFileChange = (event) => {
  form.image_01 = event.target.files[0]
  dropzoneFile.value = form.image_01.name
}
const submit = () => {
    form.put(route('product.update', [props.product.id]))
}

const deleteStore = (id) => {
    router.delete(route('product.delete', [id]), {}, {});
}

</script>

<template>
  
<div class="p-6 font-sans text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100 antialiased">
<form v-on:submit.prevent="submit">
<div class=" p-4 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250 ">
    <p class="text-3xl text-center mb-2">EDIT PRODUCT</p>
    <div class="grid xl:grid-cols-3 sm:grid-cols-1">
    <!-- DropZone -->
    <div class=" mr-5">
        <DropZone @imageFile="receiveImageFile" @change="handleFileChange" :imageEdit="product.image_01" :class="{'border border-red-500 dark:border-red-500' : errors.image_01}" @focus="errors.image_01 = ''"/>
        <input class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full h-10 mt-5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-white' :class="{'border-red-500 dark:border-red-500' : errors.image_01}" @focus="errors.image_01 = ''" :placeholder="dropzoneFile" disabled/>
        <p v-if="errors.image_01" class="text-red-500 text-sm font-bold flex">{{ errors.image_01 }}</p>
    </div>
    <!-- Dropzone -->
    <div class="xl:col-span-2 sm:col-span-1">
        <label for=productName class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Product Name</label>
        <input
            v-model="form.productName" 
            type='text' 
            id=productName 
            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            :class="{'border-red-500 dark:border-red-500' : errors.productName}"
            @focus="errors.productName = ''"
        />
        <div v-if="errors.productName" class="text-red-500 text-sm font-bold">{{ errors.productName }}</div>
        <label for=shortDescription class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Short Description</label>
        <input
            v-model="form.shortDescription" 
            type='text' 
            id=shortDescription 
            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            :class="{'border-red-500 dark:border-red-500' : errors.shortDescription}"
            @focus="errors.shortDescription = ''"
        />
        <div v-if="errors.shortDescription" class="text-red-500 text-sm font-bold">{{ errors.shortDescription }}</div>
        <label for=company class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Company</label>
        <input 
            v-model="form.company"
            type='text' 
            id=company
            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            :class="{'border-red-500 dark:border-red-500' : errors.company}"
            @focus="errors.company = ''"
        />
        <div v-if="errors.company" class="text-red-500 text-sm font-bold">{{ errors.company }}</div>
        <label for=brand class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Brand</label>
        <input 
            v-model="form.brand"
            type='text' 
            id=brand
            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            :class="{'border-red-500 dark:border-red-500' : errors.brand}"
            @focus="errors.brand = ''"
        />
        <div v-if="errors.brand" class="text-red-500 text-sm font-bold">{{ errors.brand }}</div>
        <label for=price class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Price</label>
        <input
            v-model="form.price" 
            type='text' 
            id=price 
            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            :class="{'border-red-500 dark:border-red-500' : errors.price}"
            @focus="errors.price = ''"
        />
        <div v-if="errors.price" class="text-red-500 text-sm font-bold">{{ errors.price }}</div>
        <label for=stock class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Stock</label>
        <input
            v-model="form.stock" 
            type='text' 
            id=stock 
            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            :class="{'border-red-500 dark:border-red-500' : errors.stock}"
            @focus="errors.stock = ''"
        />
        <div v-if="errors.stock" class="text-red-500 text-sm font-bold">{{ errors.stock }}</div>
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
        <label for=website class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Website</label>
        <input
            v-model="form.website"
            type='text' 
            id=website
            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            :class="{'border-red-500 dark:border-red-500' : errors.website}"
            @focus="errors.website = ''"
        />
        <div v-if="errors.website" class="text-red-500 text-sm font-bold">{{ errors.website }}</div>
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
        <label for=priority class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Priority</label>
        <select
            v-model="form.priority" 
            id="priority"
            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
            :class="{'border-red-500 dark:border-red-500' : errors.priority}"
            @focus="errors.priority = ''"
        >
            <option value="3">None</option>
            <option value="2">Secondary</option>
            <option value="1">Primary</option>
        </select>
        <div v-if="errors.priority" class="text-red-500 text-sm font-bold">{{ errors.priority }}</div>
        <div class="flex items-center">
            <label for=remember class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Remember</label>
            <input
                v-model="form.remember" 
                type='checkbox' 
                id=remember 
                class='bg-gray-50 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-300 dark:border-gray-600'
                :class="{'border-red-500 dark:border-red-500' : errors.remember}"
                @focus="errors.remember = ''"
            />
            <span class="ml-3 text-blue-200 text-lg">Termino and condition</span>
        </div>
        <div v-if="errors.remember" class="text-red-500 text-sm font-bold">{{ errors.remember }}</div>
        <div class="flex justify-end items-center gap-6">
            <Link :href="route('dashboard.index')" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-900 dark:focus:ring-gray-900">{{ $t('Close') }}</Link>
            <button type="submit" class="my-5 text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800 ">{{ $t('Update') }}</button>
            <button type="button" @click="deleteStore(props.product.id)" class="my-5 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">{{ $t('Delete') }}</button>
        </div>
    </div>
</div>
</div>
</form>
</div>

</template>

