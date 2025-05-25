<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const activeIndex = ref(0);
const items = ref([]);

onMounted(() => {
  items.value = document.querySelectorAll('[data-carousel-item]');
  showItem(activeIndex.value);
});

function showItem(index) {
  items.value.forEach((item, i) => {
    item.classList.toggle('hidden', i !== index);
  });
}

function next() {
  activeIndex.value = (activeIndex.value + 1) % items.value.length;
  showItem(activeIndex.value);
}

function prev() {
  activeIndex.value = (activeIndex.value - 1 + items.value.length) % items.value.length;
  showItem(activeIndex.value);
}
</script>

<template>
<Head title="Carousel" />
<AuthenticatedLayout>
<div class="grid grid-flow-col m-10">
  <div id="indicators-carousel" class="relative" data-carousel="static">
      <div class="relative overflow-hidden rounded-lg">
          <div class="hidden duration-700 ease-in-out w-full h-96 bg-blue-700" data-carousel-item>1</div>
          <div class="hidden duration-700 ease-in-out w-full h-96 bg-blue-600" data-carousel-item>2</div>
          <div class="hidden duration-700 ease-in-out w-full h-96 bg-blue-500" data-carousel-item>3</div>
          <div class="hidden duration-700 ease-in-out w-full h-96 bg-blue-400" data-carousel-item>4</div>
          <div class="hidden duration-700 ease-in-out w-full h-96 bg-blue-300" data-carousel-item>5</div>
      </div>
      <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
          <button type="button" class="w-6 h-6 rounded-full bg-slate-400" :class="{'bg-slate-900': activeIndex == 0}"  @click="activeIndex = 0; showItem(0)">1</button>
          <button type="button" class="w-6 h-6 rounded-full bg-slate-400" :class="{'bg-slate-900': activeIndex == 1}"  @click="activeIndex = 1; showItem(1)">2</button>
          <button type="button" class="w-6 h-6 rounded-full bg-slate-400" :class="{'bg-slate-900': activeIndex == 2}"  @click="activeIndex = 2; showItem(2)">3</button>
          <button type="button" class="w-6 h-6 rounded-full bg-slate-400" :class="{'bg-slate-900': activeIndex == 3}"  @click="activeIndex = 3; showItem(3)">4</button>
          <button type="button" class="w-6 h-6 rounded-full bg-slate-400" :class="{'bg-slate-900': activeIndex == 4}"  @click="activeIndex = 4; showItem(4)">5</button>
      </div>
      <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" @click="prev">
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
          </svg>
          <span class="sr-only">Previous</span>
      </span>
      </button>
      <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" @click="next">
          <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="sr-only">Next</span>
          </span>
      </button>
  </div>
</div>
</AuthenticatedLayout>
</template>