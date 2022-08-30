<template>
    <AppLayout title="Users">
        <template #header>
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="text-xl font-bold leading-5 text-violet-900 sm:text-xl sm:truncate">Prescription Management</h2>
                </div>
                <div class=" flex justify-end">
                    <Link :href="route('prescriptions.create')" v-if="$page.props.user.permissions.PRESCRIPTION_ADD">
                        <JetButton>Add Prescription</JetButton>
                    </Link>
                </div>
            </div>
        </template>

        <template #body>

            <Table>

                <template #thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </template>

                <template #tbody>
                    <tr class="hover:bg-violet-100"  v-for="prescription in $page.props.prescriptions" :key="prescription.index">
                        <td class="border border-viloet-300 p-3">01</td>
                        <td class="border border-viloet-300 p-3">{{ prescription.customer.first_name +' '+prescription.customer.last_name }}</td>
                        <td class="border border-viloet-300 p-3">
                            <span class="text-white p-1 rounded-md" :class=" 
                                    prescription.status == NULL
                                    ? 'bg-blue-500'
                                    :(prescription.status == 0 
                                    ? 'bg-red-500'
                                    :(prescription.status == 1
                                    ? 'bg-green-500'
                                    : 'bg-orange-500'))"
                            >
                                {{ 
                                    prescription.status == NULL
                                    ? 'New'
                                    :(prescription.status == 0 
                                    ? 'Reject'
                                    :(prescription.status == 1
                                    ? 'Accept'
                                    : 'Quotation Sent'))
                                }}
                            </span>
                        </td>
                        <td class="border border-viloet-300 p-3">
                            <Link :href="route('prescriptions.show',prescription.id)">
                                <JetButton class="py-1 my-1">View</JetButton>
                            </Link>
                        </td>
                    </tr>
                </template>

            </Table>
            
        </template>
    </AppLayout>
</template>

<script>
import { defineComponent,computed } from 'vue'
import { Head, Link, usePage  } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import Table from '@/Components/Table.vue';

export default  {

    setup() {
        let userr = computed(() => usePage().props.value.prescription)
        return { userr }
      },

    components: {
        JetButton,
        AppLayout,
        Link,
        Table
    },
    

    methods: {

    }

};

</script>
