<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Table from '@/Components/Table.vue';

defineProps({
    users: Object,
});
</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="text-xl font-bold leading-5 text-violet-900 sm:text-xl sm:truncate">User Management</h2>
                </div>
                <div class=" flex justify-end">
                    <Link :href="route('users.create')">
                        <JetButton>Add User</JetButton>
                    </Link>
                </div>
            </div>
        </template>

        <template #body>

            <Table>

                <template #thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Type</th>
                    </tr>
                </template>

                <template #tbody>
                    <tr class="hover:bg-violet-100"  v-for="user in users" :key="user.index">
                        <td class="border border-viloet-300 p-3">01</td>
                        <td class="border border-viloet-300 p-3">{{ user.first_name+' '+user.first_name }}</td>
                        <td class="border border-viloet-300 p-3">{{ user.email }}</td>
                        <td class="border border-viloet-300 p-3">{{ user.contact_no }}</td>
                        <td class="border border-viloet-300 p-3">
                            <span class="bg-green-400 rounded-xl px-2 py-1">
                                {{ user.type == 1 ? 'Pharmacy' : 'User' }}
                            </span>
                        </td>
                    </tr>
                </template>

            </Table>
            
        </template>
    </AppLayout>
</template>
