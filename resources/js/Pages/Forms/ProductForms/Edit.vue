<script setup>
import { useForm, router, Link, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'
import DropZone from "@/Components/DropZone.vue"
import CardMobile from "@/Components/CardMobile.vue"
import InputFull from "@/Components/InputFull.vue"


const page = usePage()
const props = defineProps({
    product: {type: Object}
})

const form = useForm({
    id: props.product.id,
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
////// Image ////////
const dropzoneFile = ref(props.product.image_01)
const receiveImageFile = (image) => { dropzoneFile.value = image }
const handleFileChange = (event) => {
  form.image_01 = event.target.files[0]
  dropzoneFile.value = form.image_01.name
}
///// Form //////////
const submit = () => {
    form.post(route('product.update'), {onSuccess: () => { emit('closeEdit') }}
)}
const emit = defineEmits(['closeEdit'])

</script>

<template>
<div class="w-full h-full p-16 fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
<CardMobile >

<form v-on:submit.prevent="submit" class="w-full h-[80vh]" >

    <div class="flex justify-center items-center mb-5">
        <span class="w-5/6 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">Create New Product</span>
        <div class="w-1/6 flex justify-end">
            <button @click="emit('closeEdit')" class="text-gray-600 dark:text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:bg-gray-600">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="grid xl:grid-cols-3 sm:grid-cols-1 ">
        <!-- DropZone -->
        <div class="mr-5">
            <DropZone @imageFile="receiveImageFile" @change="handleFileChange" :imageEdit="product.image_01" :class="{'border border-red-500 dark:border-red-500' : page.props.errors.image_01}" @focus="page.props.errors.image_01 = ''"/>
            <InputFull
                v-model:model="dropzoneFile"
                v-model:errors="page.props.errors.image_01"
                :label="$t('Profile Photo')"
                :type="'text'"
                :id="'image_01'"
                ref="image_01"
            />
        </div>
        <!-- Dropzone -->
        <div class="xl:col-span-2 sm:col-span-1">
            <InputFull
                v-model:model="form.productName"
                v-model:errors="page.props.errors.productName"
                :label="$t('Product Name')"
                :type="'text'"
                :id="'productName'"
                ref="productName"
            />
            <InputFull
                v-model:model="form.shortDescription"
                v-model:errors="page.props.errors.shortDescription"
                :label="$t('Description')"
                :type="'text'"
                :id="'shortDescription'"
                ref="shortDescription"
            />
            <InputFull
                v-model:model="form.company"
                v-model:errors="page.props.errors.company"
                :label="$t('Company')"
                :type="'text'"
                :id="'company'"
                ref="company"
            />
            <InputFull
                v-model:model="form.brand"
                v-model:errors="page.props.errors.brand"
                :label="$t('Brand')"
                :type="'text'"
                :id="'brand'"
                ref="brand"
            />
            <InputFull
                v-model:model="form.price"
                v-model:errors="page.props.errors.price"
                :label="$t('Price')"
                :type="'text'"
                :id="'price'"
                ref="price"
            />
            <InputFull
                v-model:model="form.stock"
                v-model:errors="page.props.errors.stock"
                :label="$t('Stock')"
                :type="'text'"
                :id="'stock'"
                ref="stock"
            />
            <InputFull
                v-model:model="form.address"
                v-model:errors="page.props.errors.address"
                :label="$t('Address')"
                :type="'text'"
                :id="'address'"
                ref="address"
            />
            <InputFull
                v-model:model="form.website"
                v-model:errors="page.props.errors.website"
                :label="$t('Website')"
                :type="'text'"
                :id="'website'"
                ref="website"
            />
            <InputFull
                v-model:model="form.email"
                v-model:errors="page.props.errors.email"
                :label="$t('Email')"
                :type="'email'"
                :id="'email'"
                ref="email"
            />
            <label for=priority class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Priority</label>
            <select
                v-model="form.priority" 
                id="priority"
                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                :class="{'border-red-500 dark:border-red-500' : page.props.errors.priority}"
                @focus="page.props.errors.priority = ''"
            >
                <option value="3">None</option>
                <option value="2">Secondary</option>
                <option value="1">Primary</option>
            </select>
            <div v-if="page.props.errors.priority" class="text-red-500 text-sm font-bold">{{ page.props.errors.priority }}</div>
            <div class="flex items-center">
                <label for=remember class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>Remember</label>
                <input
                    v-model="form.remember" 
                    type='checkbox' 
                    id=remember 
                    class='bg-gray-50 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-300 dark:border-gray-600'
                    :class="{'border-red-500 dark:border-red-500' : page.props.errors.remember}"
                    @focus="page.props.errors.remember = ''"
                />
                <span class="ml-3 text-blue-200 text-lg">Termino and condition</span>
            </div>
            <div v-if="page.props.errors.remember" class="text-red-500 text-sm font-bold">{{ page.props.errors.remember }}</div>
            <div class="flex justify-end items-center gap-6">
                <Link :href="route('product.index')" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-800 dark:focus:ring-gray-900">{{ $t('Close') }}</Link>
                <button type="submit" class="m-3 text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800">{{ $t('Update Product') }}</button>
            </div>
        </div>
    </div>

</form>
</CardMobile>
</div>
</template>

