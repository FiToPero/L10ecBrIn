<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CardMobile from '../Components/CardMobile.vue';

const props = defineProps({
   chats: Array,
   messages: Array,
   photoUrl: String,
})


</script>
<template>
    <Head title="Chat WhatsApp" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Chat Whatsapp') }}</h2>
    </template>
<div class="container mx-auto p-4 text-gray-900 dark:text-white">
<CardMobile>
   <div class="w-full h-[580px] flex border border-gray-300 dark:border-gray-700 rounded-lg"> <!-- Contenedor con altura fija -->
   <!-- chat list -->
   <div class="flex flex-col w-2/5 h-full border-r-2 border-gray-300 dark:border-gray-700">
      <!-- search compt -->
      <div class="border-b-2 border-gray-200 dark:border-gray-700 py-4 px-2 flex-shrink-0">
         <input type="text" placeholder="search chatting" class="py-2 px-2 border-2 border-gray-200 dark:border-gray-600 rounded-2xl w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-400" />
      </div>
      <!-- user list -->
      <div class="flex-1 overflow-y-auto ">
         <template v-for="chat in props.chats" :key="chat.id">
            <div class="flex flex-row py-4 px-2 items-center border-b-2 border-gray-200 dark:border-gray-700 border-l-4 border-l-blue-400 dark:border-l-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 cursor-pointer bg-white dark:bg-gray-800">
               <div class="w-1/4 flex-shrink-0">
                  <img :src="photoUrl" class="object-cover h-12 w-12 rounded-full" alt="" />
               </div>
               <div class="w-full min-w-0">
                  <div class="text-lg font-semibold truncate text-gray-900 dark:text-white">{{ chat.name }}</div>
                  <div class="text-gray-500 dark:text-gray-400 text-sm truncate">{{ chat.chatId }}</div>
                  <div class="text-gray-400 dark:text-gray-300 text-xs">Is Group: {{ chat.isGroup }}</div>
               </div>
            </div>
         </template>
      </div>
      <!-- end user list -->
   </div>
   <!-- end chat list -->


   <!-- message -->
   <div class="w-full px-5 flex flex-col justify-between">
      <div class="flex flex-col mt-5 overflow-y-auto flex-1">
         <div class="flex justify-end mb-4">
            <div
            class="mr-2 py-3 px-4 bg-blue-500 dark:bg-blue-600 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white shadow-md"
            >
            Welcome to group everyone !
            </div>
            <img :src="photoUrl" class="object-cover h-8 w-8 rounded-full" alt="" />
         </div>
         <div class="flex justify-start mb-4">
            <img :src="photoUrl" class="object-cover h-8 w-8 rounded-full" alt="" />
            <div
            class="ml-2 py-3 px-4 bg-gray-200 dark:bg-gray-700 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-gray-900 dark:text-white shadow-md"
            >
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
            at praesentium, aut ullam delectus odio error sit rem. Architecto
            nulla doloribus laborum illo rem enim dolor odio saepe,
            consequatur quas?
            </div>
         </div>
         <div class="flex justify-end mb-4">
            <div>
            <div
               class="mr-2 py-3 px-4 bg-blue-500 dark:bg-blue-600 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white shadow-md"
            >
               Lorem ipsum dolor, sit amet consectetur adipisicing elit.
               Magnam, repudiandae.
            </div>

            <div
               class="mt-4 mr-2 py-3 px-4 bg-blue-500 dark:bg-blue-600 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white shadow-md"
            >
               Lorem ipsum dolor sit amet consectetur adipisicing elit.
               Debitis, reiciendis!
            </div>
            </div>
            <img :src="photoUrl" class="object-cover h-8 w-8 rounded-full" alt="" />
         </div>
         <div class="flex justify-start mb-4">
            <img :src="photoUrl" class="object-cover h-8 w-8 rounded-full" alt="" />
            <div
            class="ml-2 py-3 px-4 bg-gray-200 dark:bg-gray-700 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-gray-900 dark:text-white shadow-md"
            >
            happy holiday guys!
            </div>
         </div>
      </div>
      <div class="py-5 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
         <input
            class="w-full bg-gray-100 dark:bg-gray-700 py-5 px-3 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 border border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:outline-none"
            type="text"
            placeholder="type your message here..."
         />
      </div>
   </div>
   <!-- end message -->
   </div>
</CardMobile>
   <p class="text-white m-5">{{ messages }}</p>
</div>
</AuthenticatedLayout>
</template>