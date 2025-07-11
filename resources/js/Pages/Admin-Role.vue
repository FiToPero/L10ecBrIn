<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { usePage, Head, router } from '@inertiajs/vue3'
import FlashMessage from '@/Components/FlashMessage.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import Badge from '@/Components/Badge.vue'
import Create from '@/Pages/Forms/RolesForms/Create.vue'
import Modal from '@/Components/Modal.vue'

const props = defineProps({
    roles: { type: Object, required: true },
    permissions: { type: Object, required: true },
})
const page = usePage()

const isMessage = ref(false)
const modalCreate = ref(false)
const rolesOld = ref(props.roles)
const modalView = ref(false)
const viewSave = ref([])
const addPermission = ref('')
let responseSave = ''

const openCreate = () => { modalCreate.value = !modalCreate.value }
const openModalView = (role) => { 
    modalView.value = !modalView.value
    responseSave =  JSON.parse(JSON.stringify(role))
}

//////// Functions ///////////
const removeBadge = (id, index) => {  
    const rolesCopy = JSON.parse(JSON.stringify(rolesOld.value)) // Clona todo el array rolesOld para asegurar reactividad y evitar proxies
    rolesCopy[index].permissions = rolesCopy[index].permissions.filter(p => Number(p.id) !== Number(id)) 
    rolesOld.value = rolesCopy // Reasigna el array completo

    if(!viewSave.value.some(item => item === index)){
        viewSave.value.push(index)
    } 
}
const saveRole = (save) => {
    router.post(route('adminRole.update'), save)
    modalView.value = false
    responseSave = ''
}
const cancelUpdate = (cancel) => {    
    const rolesOriginal = JSON.parse(JSON.stringify(props.roles))
    let rolePermissionsOriginal = rolesOriginal[cancel] 

    const viewSaveCopy = JSON.parse(JSON.stringify(viewSave.value))
    if(viewSaveCopy.filter(i => i !== cancel)){
        viewSave.value = viewSaveCopy.filter(i => i !== cancel)
        rolesOld.value[cancel] = rolePermissionsOriginal
    }
}

watch(addPermission, (newValue) => {
    const rolesCopy = JSON.parse(JSON.stringify(rolesOld.value))
    const exists = rolesCopy[newValue.index].permissions.some(p => Number(p.id) === Number(newValue.id))
    if (!exists) {
        rolesCopy[newValue.index].permissions.push({id: newValue.id, name: newValue.name})
    }
    rolesOld.value = rolesCopy

    if(!viewSave.value.some(item => item === newValue.index)){
        viewSave.value.push(newValue.index)
    }
})
watch(
  () => props.roles,
  (newRoles) => {
    rolesOld.value = JSON.parse(JSON.stringify(newRoles))
  }
)

///////  Mesage Flash ///////
const closeMessage = () => { 
    isMessage.value = false
    page.props.flash.message = null
    page.props.flash.color = null
}
watch(() => page.props.flash.message, (newValue) => {
  if (newValue) {
    isMessage.value = true;
  }
}, { immediate: true })

</script>

<template>
<Head title="Admin-Root" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Admin-Root') }}</h2>
    </template>
    <div class="w-full  p-3">

        <FlashMessage v-if="isMessage" :message=$page.props.flash.message :color="$page.props.flash.color" @closeMessage="closeMessage"  />

        <!-- CREATE BUTTON -->
        <div class="my-5">
            <ButtonColor text="white" bg="green" v-if="page.props.auth.user.permissions.includes('create_role')" @click="openCreate()" class="px-10 py-4" >{{ $t('Create New Role') }}</ButtonColor>
        </div>
        <!-- MODAL CREATE -->
        <Create v-if="modalCreate" @closeCreate="openCreate" :permissions="props.permissions" />
        <!--   MODAL MESSAGE -->
        <Modal :show="modalView" maxWidth="lg" @close="openModalView" >
            <p class="my-5 mx-auto text-xl dark:text-white font-semibold mb-4">{{ $t('Are you sure to Update this Role?') }}</p>
            <div class="flex justify-center my-5">
                <ButtonColor text="white" bg="gray" @click="openModalView" class="mr-10">{{ $t('Cancel') }}</ButtonColor>
                <ButtonColor text="white" bg="cyan"  @click=saveRole(responseSave)>{{ $t('Update Role') }}</ButtonColor>
            </div>
        </Modal>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-3 w-3">
                                {{ $t('ID') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ $t('Role Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ $t('Add Permission') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ $t('Permissions') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ $t('Save') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(role, index) in rolesOld" :key="'roles'+index">
                            <tr class="    bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="p-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p class="dark:text-white">{{ role.id }}</p>
                                </th>
                                <td class="p-2 font-medium text-gray-900 whitespace-nowrap">
                                    <p class="dark:text-white">{{ role.name }}</p>
                                </td>
                                <td class="p-2 m-10 font-medium text-gray-900 whitespace-nowrap">
                                    <label class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>{{ $t('Select Permission') }}</label>
                                    <select v-model="addPermission" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <template v-for="permission in permissions" :key="'select'+role.id" >
                                            <option :value="{id: permission.id, name: permission.name, index}"   >{{ permission.name }}</option>
                                        </template>
                                    </select>   
                                </td>
                                <td id="badge" class="  flex flex-wrap gap-1 p-2 font-medium text-gray-900 whitespace-nowrap">
                                    <template v-for="permission in role.permissions" :key="'permissions'+permission.id">
                                        
<span class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-blue-800 bg-blue-100 rounded-sm dark:bg-blue-900 dark:text-blue-300">
    {{ permission.name }}
    <button @click="removeBadge(permission.id, index)" class="inline-flex items-center p-1 ms-2 text-sm text-blue-400 bg-transparent rounded-xs hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300" >
        <svg class="w-2 h-2" aria-hidden="tru</button>e" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</span>
                                    </template>
                                </td>
                                <td class="p-5 font-medium" >
                                    <div class="flex justify-center gap-2">
                                    <ButtonColor text="white" bg="green" v-if="page.props.auth.user.permissions.includes('update_role') && viewSave.some(item => item === index)" @click="openModalView(role)"  >{{ $t('Save') }}</ButtonColor>
                                    <ButtonColor text="white" bg="red" v-if="page.props.auth.user.permissions.includes('update_role') && viewSave.some(item => item === index)" @click="cancelUpdate(index)"  >{{ $t('Cancel') }}</ButtonColor>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
</template>
