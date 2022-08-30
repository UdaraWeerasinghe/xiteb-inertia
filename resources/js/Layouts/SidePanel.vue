<script setup>

import { Link } from '@inertiajs/inertia-vue3'

</script>
<template>
    <div class="w-48 text-gray-900">
        <Link v-for="menu in $page.props.user.menu" :key="menu.index" :href="route(menu.route)">
            <button type="button" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-violet-200 rounded-lg hover:bg-violet-100 hover:violet-blue-900 focus:z-10 focus:bg-violet-200 focus:text-violet-900 focus:font-bold">
                {{ menu.name }}
            </button>
        </Link>
    </div>
</template>
