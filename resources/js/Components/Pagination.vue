<script>
import { Link } from '@inertiajs/vue3'
export default {
    props: {
        links: Object
    },
    components: {
      Link
    }
}
</script>

<template>
<div class="flex items-center justify-between px-4 py-3 md:px-6">
  <div class="flex flex-1 justify-between md:hidden">
    <Link v-if="links.prev_page_url" :href="links.prev_page_url" v-html="'&laquo; Previous'" preserve-scroll class="relative inline-flex items-center px-4 py-2 text-sm text-gray-800 dark:text-gray-100 font-semibold bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250"/>
    <Link v-if="links.next_page_url" :href="links.next_page_url" v-html="'Next &raquo;'" preserve-scroll class="relative inline-flex items-center px-4 py-2 text-sm text-gray-800 dark:text-gray-100 font-semibold bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250"/>
  </div>
  <div class="hidden md:flex md:flex-1 md:items-center md:justify-between">
    <div>
      <p class="p-3 text-lg text-gray-700 dark:text-gray-100">
        Showing
        <span class="font-medium">{{ links.current_page }}</span>
        to
        <span class="font-medium">{{ links.last_page }}</span>
        of
        <span class="font-medium">{{ links.total }}</span>
        results
      </p>
    </div>
    <div>
      <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
        <template v-for="link in links.links">
          <Link v-if="link.url" :href="link.url" v-html="link.label" preserve-scroll :class="{'border-2 border-red-500': link.active, }" class="relative inline-flex items-center px-4 py-2 text-sm text-gray-800 dark:text-gray-100 font-semibold bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250"/>
        </template>
      </nav>
    </div>
  </div>
</div>
      
</template>
