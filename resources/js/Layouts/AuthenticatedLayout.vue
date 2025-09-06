<script setup>
import { ref, computed } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link, usePage } from '@inertiajs/vue3'
import Login from '@/Pages/Auth/Login.vue'
import Register from '@/Pages/Auth/Register.vue'
import VerifyEmail from '@/Pages/Auth/VerifyEmail.vue'
import ForgotPassword from '@/Pages/Auth/ForgotPassword.vue'
import ResetPassword from '@/Pages/Auth/ResetPassword.vue'
import ProfileEdit from '@/Pages/Profile/Edit.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import { useLoginStore } from '@/stores/useLoginStore'
import { storeToRefs } from 'pinia'


///// pinia ////
const storeLogin = useLoginStore()
const { modalLogin, modalRegister, modalVerified, modalForgotPassword, modalResetPassword, modalProfileEdit } = storeToRefs(storeLogin)
const { showModalLogin, showModalRegister, showModalForgotPassword, showModalResetPassword, showModalProfileEdit, changeLocale } = storeLogin

const page = usePage()

const selectedLang = ref(localStorage.getItem('localeLang')||'en')
const showingNavigationDropdown = ref(false)

const selectLang = (e) => { changeLocale(e.target.value) }

</script>

<template>
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class=" px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('welcome.index')">
                            <ApplicationLogo
                                class="block h-24 w-auto fill-current text-gray-800 dark:text-gray-200"
                            />
                        </Link>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <NavLink :href="route('welcome.index')" :active="route().current('welcome.index')">
                            {{ $t('Welcome') }}
                        </NavLink>
                        <NavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_carousel')" :href="route('carousel.index')" :active="route().current('carousel.index')">
                            {{ $t('Carousel') }}
                        </NavLink>
                        <NavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_product')" :href="route('product.index')" :active="route().current('product.index')">
                            {{ $t('Product') }}
                        </NavLink>
                        <NavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_user')" :href="route('adminUser.index')" :active="route().current('adminUser.index')">
                            {{ $t('Admin-User') }}
                        </NavLink>
                        <NavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_role')" :href="route('adminRole.index')" :active="route().current('adminRole.index')">
                            {{ $t('Admin-Role') }}
                        </NavLink>
                        <NavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_chat')" :href="route('chat.index')" :active="route().current('chat.index')">
                            {{ $t('Chat-Whatsapp') }}
                        </NavLink> 
                        <!-- <div class="p-3 text-white text-sm">{{ page.props.auth.user.permissions }}</div> -->
                    </div>
                </div>
                <div class="">
                    <!-- -------- button logins -->
                    <template v-if="!$page.props.auth.user" >
                        <div class="hidden sm:flex">
                            <select 
                                id="lang" @change="selectLang" v-model="selectedLang"
                                class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                            >
                                <option value="en">English</option>
                                <option value="it">Italiano</option>
                                <option value="es">Español</option>
                            </select>
                            
                            <ButtonColor text="white" bg="gray" @click="showModalRegister" class="m-3 " >Register</ButtonColor>
                            <ButtonColor text="white" bg="gray" @click="showModalLogin" class="m-3 ">Login</ButtonColor>                            
                        </div>
                    </template>
                    <template v-else>
                    <!-- -------- -- button logins -->
                        <div class="hidden sm:flex sm:items-center h-full w-full">
                            <select 
                                id="lang" @change="selectLang" v-model="selectedLang"
                                class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                            >
                                <option value="en">English</option>
                                <option value="it">Italiano</option>
                                <option value="es">Español</option>
                            </select>
                            <!-- Settings Dropdown -->
                            <div class="relative w-full">
                                <Dropdown align="right">
                                    <template #trigger>
                                        <span class="inline-flex justify-end rounded-md border border-gray-300 w-full">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-200 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.username }}
                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>
                                    <template #content>
                                        <DropdownLink @click="showModalProfileEdit" > {{ $t('Profile') }} </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button"> {{ $t('Log Out') }} </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    <!-- button login template close -->
                    </template>
                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden h-full w-full">
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown" 
                            class="w-full py-3 px-5 border border-gray-400 items-center justify-center rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-full" stroke="currentColor" fill="none" viewBox="0 0 19 19">
                                <path :class="{hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown,}"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown,}"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('welcome.index')" :active="route().current('welcome.index')">
                    {{ $t('Welcome') }}
                </ResponsiveNavLink> 
                <ResponsiveNavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_carousel')" :href="route('carousel.index')" :active="route().current('carousel.index')">
                    {{ $t('Carousel') }}
                </ResponsiveNavLink>
                <ResponsiveNavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_product')" :href="route('product.index')" :active="route().current('product.index')">
                    {{ $t('product') }}
                </ResponsiveNavLink>
                <ResponsiveNavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_user')" :href="route('adminUser.index')" :active="route().current('adminUser.index')">
                    {{ $t('Admin-User') }}
                </ResponsiveNavLink>
                <ResponsiveNavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_role')" :href="route('adminRole.index')" :active="route().current('adminRole.index')">
                    {{ $t('Admin-Role') }}
                </ResponsiveNavLink>
                <ResponsiveNavLink v-if="page.props.auth.user && page.props.auth.user.permissions && page.props.auth.user.permissions.includes('viewAny_chat')" :href="route('chat.index')" :active="route().current('chat.index')">
                    {{ $t('Chat-Whatsapp') }}
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <template v-if="$page.props.auth.user">
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <select 
                        id="lang" @change="selectLang" v-model="selectedLang"
                        class=" text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                    >
                        <option value="en">English</option>
                        <option value="it">Italiano</option>
                        <option value="es">Español</option>
                    </select>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                        {{ $page.props.auth.user.username }}
                    </div>
                    <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink @click="showModalProfileEdit" > {{ $t('Profile') }} </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('logout')" method="post" as="button"> {{ $t('Log Out') }} </ResponsiveNavLink>
                </div>
            </div>
            </template>
            <template v-else>
                <div class="mx-10 flex justify-center gap-5">
                    <div class="w-full mx-3">
                        <select 
                            id="lang" @change="selectLang" v-model="selectedLang"
                            class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                        >
                            <option value="en">English</option>
                            <option value="it">Italiano</option>
                            <option value="es">Español</option>
                        </select>
                    </div>
                    <ButtonColor text="white" bg="gray" @click="showModalRegister" class="m-3 " >Register</ButtonColor>
                    <ButtonColor text="white" bg="gray" @click="showModalLogin" class="m-3 ">Login</ButtonColor>                            
                </div>
            </template>
        </div>

        
    </nav>

    <!-- Page Heading -->
    <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <slot name="header" />
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <Login v-if="modalLogin" />
        <Register v-if="modalRegister" />
        <VerifyEmail v-if="modalVerified" />
        <ForgotPassword v-if="modalForgotPassword" />
        <ResetPassword v-if="modalResetPassword" />
        <ProfileEdit v-if="modalProfileEdit" :props="$page.props" />
        <slot />
    </main>
</template>
