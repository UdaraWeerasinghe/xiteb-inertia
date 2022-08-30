<template>
    <AppLayout title="Users">
        <template #header>
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="text-xl font-bold leading-5 text-violet-900 sm:text-xl sm:truncate">
                        <Link :href="route('prescriptions.index')">Prescription Management </Link> \ Add Prescription
                    </h2>
                </div>
            </div>
        </template>

        <template #body>
            <form @submit.prevent="form.post(route('prescriptions.store'))">
                <div class="grid grid-cols-6 gap-6 md:grid-cols-12">
                    
                    <div class="col-span-6 mt-4">

                        <div class="col-span-6 mt-4">
                            <JetLabel for="note" value="Note" />
                            <JetInput
                                id="note"
                                v-model="form.note"
                                type="text"
                                class="mt-1 block w-full p-1"
                                required
                            />
                            <ErrorLabel v-if="$page.props.errors.note" :value="$page.props.errors.note" />
                        </div>
                        <div class="col-span-6 mt-4">
                            <JetLabel for="delivery_address" value="Delivery address" />
                            <JetInput
                                id="delivery_address"
                                v-model="form.delivery_address"
                                type="text"
                                class="mt-1 block w-full p-1"
                                required
                            />
                            <ErrorLabel v-if="$page.props.errors.delivery_address" :value="$page.props.errors.delivery_address" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1 mt-4">
                                <JetLabel for="delivery_date" value="Delivery Date" />
                                <JetInput
                                    id="date"
                                    v-model="form.delivery_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <ErrorLabel v-if="$page.props.errors.delivery_date" :value="$page.props.errors.delivery_date" />
                            </div>

                            <div class="col-span-1 mt-4">
                                <JetLabel for="delivery_time_slot" value="Time" />
                                <select name="delivery_time_slot" id="delivery_time_slot" v-model="form.delivery_time_slot"
                                    class="border-gray-300 focus:border-violet-300 focus:ring focus:ring-violet-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                                    <option v-for="timeSlot in $page.props.timeSlots" :key="timeSlot.index" :value="timeSlot">{{ timeSlot }}</option>
                                </select>
                                <ErrorLabel v-if="$page.props.errors.delivery_time_slot" :value="$page.props.errors.delivery_time_slot" />
                            </div>
                        </div>

                    </div>


                    <div class="col-span-6 mt-4">
                        <div class="col-span-6 mt-4">
                            <JetLabel for="image_1" value="Images" />
                            <JetInput
                                @change="uploadFile"
                                id="image_1"
                                type="file"
                                accept="image/*"
                                class="mt-1 block w-full p-1"
                                required
                            />
                            <ErrorLabel v-if="$page.props.errors.image_1" :value="$page.props.errors.image_1" />
                        </div>
                        <div class="col-span-6 mt-4">
                            <span>Selected Image Count : <span class="bg-green-200 rounded-lg px-1">{{ form.images.length }}</span></span>
                        </div>
                    </div>

                    <div class="col-span-full flex justify-end">
                        <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Submit
                        </JetButton>
                    </div>
                    
                </div>
            </form>

        </template>
    </AppLayout>
</template>

<script>
import { defineComponent, ref, watchEffect } from 'vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ErrorLabel from '@/Components/ErrorLable.vue';

export default defineComponent({
    components: {
        JetButton,
        JetInput,
        JetLabel,
        AppLayout,
        ErrorLabel,
        Link
    },
        setup () {
        const form = useForm({
            images: [],
            note: '',
            delivery_address: '',
            delivery_date: '',
            delivery_time_slot: ''
        });

        return { 
            form,
            errors: Object,
            timeSlots: Object,
            }
    },
    

    methods: {
        

        uploadFile(e) { 

            if(this.form.images.length >= 5){

                alert("Maximum count is 5");
            }else{

                const id = e.path[0].id;
                const file = e.target.files[0]
    
                if (!file.type.includes('image/')) {
                    alert('Please select an image file')
                    return
                }
    
                if (typeof FileReader === 'function') {
                    const reader = new FileReader()
    
                    reader.onload = (event) => {
                    this.form.images.push(event.target.result)
                    // rebuild cropperjs with the updated source
                    // this.$refs.cropper.replace(event.target.result)
                    }
                    reader.readAsDataURL(file)
                } else {
                    alert('Sorry, FileReader API not supported')
                }

            }


        },

    }

});


</script>
