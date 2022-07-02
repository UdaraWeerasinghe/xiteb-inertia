<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
</script>

<template>
    <AppLayout title="User">
        <template #header>
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="text-xl font-bold leading-5 text-violet-900 sm:text-xl sm:truncate">User Management</h2>
                </div>
                <div class=" flex justify-end">
                    <JetButton>Add User</JetButton>
                </div>
            </div>
        </template>
    </AppLayout>
</template>
