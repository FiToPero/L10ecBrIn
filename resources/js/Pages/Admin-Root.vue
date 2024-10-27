<script setup>
import { computed, ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, usePage, router, Head } from '@inertiajs/vue3'

const isMessage = ref(false)

const page = usePage()

const props = defineProps({
    // products: { type: Object, required: true },
    // canLogin: { type: Boolean },
    // canRegister: { type: Boolean },
})

const openShow = (product) => {
    productShow.value = product
    modalShow.value = true
}
const closeShow = () => { modalShow.value = false }
const logout = () => { router.post('/logout') }  // logout(){ this.$inertia.post('/logout') }


// watch(page.props.flash.message, () => {
//         if(page.props.flash.message){ isMessage.value = true }
//     }, { immediate: true })
// watch(search, (value) => {router.get('/welcome', {search: value}, {preserveState: true})})

</script>

<template>
<Head title="Admin-Root" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Admin-Root') }}</h2>
    </template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100"><< ----  Page ADMIN Root ---- >></div>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
</template>