<script setup>
import { ref } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import { Link } from '@inertiajs/vue3'
import Login from '@/Pages/Auth/Login.vue'
import Register from '@/Pages/Auth/Register.vue'
import VerifyEmail from '@/Pages/Auth/VerifyEmail.vue'
import { useLoginStore } from '@/stores/useLoginStore'
import { storeToRefs } from 'pinia'


///// pinia ////
const storeLogin = useLoginStore()
const { modalLogin, modalRegister, modalVerified, localeLang } = storeToRefs(storeLogin)
const { showModalLogin, showModalRegister, changeLocale } = storeLogin
////// pinia ////

const selectedLang = ref(localStorage.getItem('localeLang')||'en')
const showingNavigationDropdown = ref(false)

const selectLang = (e) => { changeLocale(e.target.value) }

const logout = () => { router.post('/logout') }  // logout(){ this.$inertia.post('/logout') }


</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class=" px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard.index')">
                                    <ApplicationLogo
                                        class="block h-24 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    />
                                </Link>
                            </div>
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('product.index')" :active="route().current('product.index')">
                                    {{ $t('Welcome') }}
                                </NavLink>
                                <NavLink :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                                    {{ $t('Dashboard') }}
                                </NavLink>
                                <NavLink :href="route('adminRoot.index')" :active="route().current('adminRoot.index')">
                                    {{ $t('Admin-Root') }}
                                </NavLink>
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
                                    <!-- <button @click="showModalLogin" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Login</button>
                                    <button @click="showModalRegister" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Register</button> -->
                                    <Link :href="route('login.create')" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">{{ $t('Login') }}</Link>
                                    <Link :href="route('register.create')" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">{{ $t('Register') }}</Link>
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
                                                        {{ $page.props.auth.user.name }}
                                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>
                                           

                                            <template #content>

                                                <DropdownLink :href="route('profile.edit')"> {{ $t('Profile') }} </DropdownLink>
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
                        <ResponsiveNavLink :href="route('product.index')" :active="route().current('product.index')">
                            {{ $t('Welcome') }}
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                            {{ $t('Dashboard') }}
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('adminRoot.index')" :active="route().current('adminRoot.index')">
                            {{ $t('Admin-Root') }}
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
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> {{ $t('Profile') }} </ResponsiveNavLink>
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
                            <Link :href="route('login.create')" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">{{ $t('Login') }}</Link>
                            <Link :href="route('register.create')" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">{{ $t('Register') }}</Link>
                            <!-- <button @click="showModalLogin" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Login</button> -->
                            <!-- <button @click="showModalRegister" class="m-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Register</button> -->
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
                <slot />
            </main>
        </div>
    </div>
</template>
