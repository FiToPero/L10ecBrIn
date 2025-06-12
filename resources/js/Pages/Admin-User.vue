<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, usePage, router, Head } from '@inertiajs/vue3'
import Show from '@/Pages/Forms/UserForms/Show.vue'
import UserTable from '@/Tables/UserTable.vue'
import FlashMessage from '@/Components/FlashMessage.vue'

const props = defineProps({
    users: { type: Object, required: true },
    usersTrashed: { type: Object },
    roles: { type: Object },
})

const page = usePage()

const modalShow = ref(false)
const userShow = ref('')
const isMessage = ref(false)

const openShow = (user) => {
    modalShow.value = true
    userShow.value = user
}
const closeShow = () => { modalShow.value = false }

const deleteStore = (id) => {
    router.delete(route('adminUser.delete', [id]), {}, {})   
}
const editStore = (id) => {
    router.get(route('adminUser.edit', [id]), {}, {})
}
const forceDelete = (id) => {
    router.delete(route('adminUser.forceDestroy', [id]), {}, {})   
}
const restore = (id) => {
    router.patch(route('adminUser.restore', [id]), {}, {})
}

const closeMessage = () => { 
    isMessage.value = false
    page.props.flash.message = null;
}

watch(() => page.props.flash.message, (newValue) => {
  if (newValue) {
    isMessage.value = true;
  }
}, { immediate: true })

</script>
<template>
    <Head title="Admin-User" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Admin-User') }}</h2>
        </template>
        <div class="w-full m-3">
            <!-- FLASH MESSAGE -->
            <FlashMessage v-if="isMessage" :message=$page.props.flash.message :color="$page.props.flash.color" @closeMessage="closeMessage"  />
            <!-- CREATE BUTTON -->
            <div class="m-5">
                <Link v-if="page.props.auth.user.permissions.includes('create_user')" :href="route('adminUser.create')" class="mb-5 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $t('Create New User') }}</Link>
            </div>
            <!-- MODAL SHOW -->
            <Show v-if="modalShow" :user="userShow" @closeShow="closeShow" />
        </div>
             
        <UserTable :users="props.users" searchName="user" v-slot="{user}" >
            <button type="button" @click="openShow(user)" class="mx-3 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 ">{{ $t('Show') }}</button>
            <button v-if="page.props.auth.user.permissions.includes('update_user')" type="button" @click="editStore(user.id)" class="mx-4 text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-136 px-2 py-1 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800 ">{{ $t('Edit') }}</button>
            <button v-if="page.props.auth.user.permissions.includes('delete_user')" type="button" @click="deleteStore(user.id)" class="mx-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">{{ $t('Delete') }}</button>
        </UserTable>

        <UserTable :users="props.usersTrashed" searchName="userTrashed" v-slot="{user}" >
            <button v-if="page.props.auth.user.permissions.includes('restore_user')" type="button" @click="restore(user.id)" class="mx-4 text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-136 px-2 py-1 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800 ">{{ $t('Restore') }}</button>
            <button v-if="page.props.auth.user.permissions.includes('forceDelete_user')" type="button" @click="forceDelete(user.id)" class="mx-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">{{ $t('Force Delete') }}</button>
        </UserTable>     

    </AuthenticatedLayout>
</template>