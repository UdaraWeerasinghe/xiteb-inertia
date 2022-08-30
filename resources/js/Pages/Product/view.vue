<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import Table from '@/Components/Table.vue';

defineProps({
    products: Object,
});

</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="text-xl font-bold leading-5 text-violet-900 sm:text-xl sm:truncate">Product Management</h2>
                </div>
                <div class=" flex justify-end">
                     <Link :href="route('products.create')">
                        <JetButton>Add Product</JetButton>
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
                        <th>Price</th>
                    </tr>
                </template>

                <template #tbody>
                    <tr class="hover:bg-violet-100"  v-for="product in products" :key="product.index">
                        <td class="border border-viloet-300 p-3">01</td>
                        <td class="border border-viloet-300 p-3">{{ product.name }}</td>
                        <td class="border border-viloet-300 p-3">{{ product.price }}</td>
                    </tr>
                </template>

            </Table>
            
        </template>
    </AppLayout>
</template>
