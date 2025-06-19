<template>
    <!-- @drop.prevent="toggleActive"    -->
    <div 
      @drop.prevent="drop" @change="selectedFile"
      
      @dragleave.prevent="toggleActive"
      @dragover.prevent="toggleActive"
      
      tabindex="0"
      :class="{ 'bg-gray-600 dark:bg-gray-300': active }"
      class="grid place-items-center p-4 sm:col-span-1 bg-white dark:bg-gray-700 dark:ring-gray-700 ring-gray-700 rounded-lg focus:outline focus:outline-2 focus:outline-blue-500"
    >
      <span class="text-black dark:text-white font-bold text-lg">Drag or Drop Image File</span>
      <span class="text-black dark:text-white font-bold text-lg">OR</span>
      <label for="dropzoneFile" class="font-bold text-lg mb-5 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-800">Select Image File</label>
      <input type="file" id="dropzoneFile" class="hidden" />
      <template v-if="dropzoneFile">
        <img class="w-full max-w-[320px] rounded-lg m-5" :src="dropzoneFile">
      </template>
      <template v-else-if="imageEdit">
        <img class="w-full max-w-[320px] rounded-lg m-5" :src="'/'+imageEdit">
      </template>
    </div>
  </template>
    
  <script setup>
  import { ref } from "vue";
  
  const image = ref('')
  const active = ref(false)
  const dropzoneFile = ref('')
  
  const props = defineProps({ imageEdit: {type: String} })
  
  const toggleActive = () => {
    active.value = !active.value
  }
  
  const drop = (e) => {
      active.value = false
      if (image.value) {
        URL.revokeObjectURL(image.value); // Liberar la URL anterior
      }
      image.value = e.dataTransfer.files[0]
      dropzoneFile.value = URL.createObjectURL(image.value)
      emit('imageFile', image.value)
  }
  
  const selectedFile = () => {
      active.value = false
      if (image.value) {
        URL.revokeObjectURL(image.value); // Liberar la URL anterior
      }
      image.value = document.querySelector("#dropzoneFile").files[0]
      dropzoneFile.value = URL.createObjectURL(image.value)
      emit('imageFile', image.value)
  }
  
  const emit = defineEmits(['imageFile'])  // envio props 
  
  </script>
  