<template>
    <AppLayout title="Users">
        <template #header>
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="text-xl font-bold leading-5 text-violet-900 sm:text-xl sm:truncate">
                        <Link :href="route('prescriptions.index')">Prescription Management </Link> \ Details
                    </h2>
                </div>
            </div>
        </template>

        <template #body>
            <div class="grid sm:grid-cols-6 xl:grid-cols-12 gap-6">

                <div class="col-span-4 gap-5 grid xl:grid-cols-8 sm:grid-cols-12">
                    <div class="col-span-4" v-for="image in $page.props.prescription.images" :key="image.index">
                        <img :src="image.path"/>
                    </div>
                </div>

                <div class="col-span-8">

                    <div class="mb-10">
                        <div class="col-span-6">
                            <JetLabel for="note" value="Note" />
                            <JetInput
                                id="note"
                                v-model="$page.props.prescription.note"
                                type="text"
                                class="mt-1 block w-full p-1"
                                readonly
                            />
                        </div>
                        <div class="col-span-6 mt-4">
                            <JetLabel for="delivery_address" value="Delivery address" />
                            <JetInput
                                id="delivery_address"
                                v-model="$page.props.prescription.delivery_address"
                                type="text"
                                class="mt-1 block w-full p-1"
                                readonly
                            />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1 mt-4">
                                <JetLabel for="delivery_date" value="Delivery Date" />
                                <JetInput
                                    id="date"
                                    v-model="$page.props.prescription.delivery_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    readonly
                                />
                            </div>

                            <div class="col-span-1 mt-4">
                                <JetLabel for="delivery_time_slot" value="Time" />
                                <JetInput
                                    id="delivery_address"
                                    v-model="$page.props.prescription.delivery_time_slot"
                                    type="text"
                                    class="mt-1 block w-full p-1"
                                    readonly
                                />
                            </div>
                        </div>
                    </div>


                    <form  @submit.prevent="form.post(route('quetations.store'))">
                         <ErrorLabel class="font-bold" v-if="$page.props.errors.prescription_id" :value="$page.props.errors.prescription_id" />
                        <Table>
                            <template #thead v-if="$page.props.user.permissions.QUETATION_ADD || $page.props.prescription.quetation.length > 0">
                                <tr>
                                    <th class="px-2" align="left">Drug</th>
                                    <th class="px-2" align="right">Quantity</th>
                                    <th class="px-2" align="right">Amount</th>
                                </tr>
                            </template>

                            <template #tbody>
                                <tr v-show="$page.props.prescription.quetation.length > 0" class="hover:bg-violet-100" v-for="item in $page.props.prescription.quetation" :key="item.index">
                                    <td class="border border-viloet-300 p-2">{{ item.product.name }}</td>
                                    <td align="right" class="border border-viloet-300 p-2">{{ item.qty }}</td>
                                    <td align="right" class="border border-viloet-300 p-2">{{ item.amount }}</td>
                                </tr>
                                <tr v-show="!$page.props.prescription.quetation.length > 0" class="hover:bg-violet-100" v-for="item in items" :key="item.index">
                                    <td class="border border-viloet-300 p-2">{{ item.name }}</td>
                                    <td align="right" class="border border-viloet-300 p-2">{{ item.qty }}</td>
                                    <td align="right" class="border border-viloet-300 p-2">{{ item.amount }}</td>
                                </tr>
                            </template>
                        </Table>

                        <div v-if="!$page.props.prescription.quetation.length > 0 && $page.props.user.permissions.QUETATION_ADD">
                            <div class="grid grid-cols-12 gap-5 mt-10">
                                <div class="col-span-6">
                                    <JetLabel for="drug" value="Drug" />
                                    <select name="drug" id="drug" v-model="selectedDrugId" class="border-gray-300 focus:border-violet-300 focus:ring focus:ring-violet-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 p-1 block w-full" @change="onChange">
                                        <option v-for="product in $page.props.products" :key="product.index" :value="product.id">{{ product.name }}</option>
                                    </select>
                                </div>
                                <div class="col-span-3">
                                    <JetLabel for="quantity" value="Quantity" />
                                    <JetInput
                                        id="quantity"
                                        v-model="selectedDrugQty"
                                        type="text"
                                        class="mt-1 text-end block w-full p-1"
                                        required
                                    />
                                </div>
                                <div class="col-span-3 pt-6"> 
                                    <JetButton type="Button" @click="addItem" class="w-full" >Add</JetButton>
                                </div>
                            </div>

                            <div class="flex justify-end mt-5">
                                <JetButton class="bg-orange-600 hover:bg-orange-500" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Send Quotation</JetButton>
                            </div>
                        </div>

                        <div v-if="$page.props.prescription.quetation.length > 0 && ($page.props.prescription.status == null || $page.props.prescription.status == 2)">
                            <div class="flex justify-end mt-5 gap-5">
                                <Link :href="'status/'+form.prescription_id+'/1'">
                                    <JetButton type="Button">Accept</JetButton>
                                </Link>
                                <Link  :href="'status/'+form.prescription_id+'/0'">
                                    <JetButton type="Button" class="bg-red-500 hover:bg-red-400">Reject</JetButton>
                                </Link>
                            </div>
                        </div>

                        <div v-if="$page.props.prescription.status != null && $page.props.prescription.status != 2">
                            <div class="flex justify-end mt-5 gap-5">
                                <span class="bg-violet-800 text-white px-10 py-5 rounded-md">
                                    {{  
                                        $page.props.prescription.status == 1
                                        ? 'Quetation has been approved'
                                        : ( $page.props.prescription.status == 0
                                            ? 'Quetation has been rejected'
                                            : '')
                                    }}
                                </span>
                            </div>
                        </div>

                    </form>


                </div>

            </div>
        </template>

    </AppLayout>
</template>

<script>
import { defineComponent, reactive, ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import Table from '@/Components/Table.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import ErrorLabel from '@/Components/ErrorLable.vue';

export default defineComponent({
    components: {
        JetButton,
        AppLayout,
        Link,
        Table,
        JetInput,
        JetLabel,
        ErrorLabel
    },
        setup () {

        const selectedDrugName = ref('');
        const selectedDrugQty = ref(0);
        const selectedDrugId = ref('');
        const items = ref([]);

        const form = useForm({
            products: [],
            prescription_id: ''
        });


        function addItem(){
            if(selectedDrugId.value == ''){
                alert('Please select a drug');
            }else if(selectedDrugQty.value == 0){
                alert('Please enter the qty');
            }else{

                items.value.push({
                    id: selectedDrugId.value,
                    name: selectedDrugName.value,
                    qty: selectedDrugQty.value
                });

                form.products = items.value;
                selectedDrugId.value = '';
                selectedDrugQty.value = 0;
            }
        }

        function onChange(){
            let e = document.getElementById("drug");
            selectedDrugName.value = e.options[e.selectedIndex].text;
        }

        return { 
            addItem,
            onChange,
            form,
            items,
            selectedDrugName,
            selectedDrugQty,
            selectedDrugId,
            }
    },
    

    mounted() {
        
        let url = window.location.pathname;
        this.form.prescription_id = url.substring(url.lastIndexOf('/') + 1);

    },

    methods: {



    }

});

</script>
