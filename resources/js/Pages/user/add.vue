<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ErrorLabel from '@/Components/ErrorLable.vue';

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    address: '',
    contact_no: '',
    dob: '',
    password: '',
    password_confirmation: '',
    type: ''
});

defineProps({
    errors: Object,
});

</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="text-xl font-bold leading-5 text-violet-900 sm:text-xl sm:truncate">
                        <Link href="/users">User Management </Link> \ Add User
                    </h2>
                </div>
            </div>
        </template>

        <template #body>
            <form @submit.prevent="form.post(route('users.store'))">
                <div class="grid grid-cols-6 gap-6 md:grid-cols-12">

                    <div class="col-span-6 mt-4">
                        <JetLabel for="first_name" value="First Name" />
                        <JetInput
                            id="first_name"
                            v-model="form.first_name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.first_name" :value="errors.first_name" />
                    </div>
                    <div class="col-span-6 mt-4">
                        <JetLabel for="last_name" value="Last Name" />
                        <JetInput
                            id="last_name"
                            v-model="form.last_name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.last_name" :value="errors.last_name" />
                    </div>

                    <div class="col-span-6 mt-4">
                        <JetLabel for="email" value="Email" />
                        <JetInput
                            id="email"
                            v-model="form.email"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.email" :value="errors.email" />

                    </div>
                    <div class="col-span-6 mt-4">
                        <JetLabel for="address" value="Address" />
                        <JetInput
                            id="address"
                            v-model="form.address"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.address" :value="errors.address" />

                    </div>

                    <div class="col-span-6 mt-4">
                        <JetLabel for="dob" value="DOB" />
                        <JetInput
                            id="dob"
                            v-model="form.dob"
                            type="date"
                            max="2012-01-01"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.dob" :value="errors.dob" />

                    </div>
                    <div class="col-span-6 mt-4">
                        <JetLabel for="contact_no" value="Contact No" />
                        <JetInput
                            id="dob"
                            v-model="form.contact_no"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.contact_no" :value="errors.contact_no" />

                    </div>

                    <div class="col-span-6 mt-4">
                        <JetLabel for="type" value="User Type" />
                        <select name="type" id="type" v-model="form.type" 
                            class="border-gray-300 focus:border-violet-300 focus:ring focus:ring-violet-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                            <option value="1">Pharmacy</option>
                            <option value="2">User</option>
                        </select>
                        <ErrorLabel v-if="errors.type" :value="errors.type" />

                    </div>
                    <br>

                    <div class="col-span-6 mt-4">
                        <JetLabel for="password" value="Password" />
                        <JetInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.password" :value="errors.password" />

                    </div>
                    <div class="col-span-6 mt-4">
                        <JetLabel for="password_confirmation" value="Password Confirmation" />
                        <JetInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.password_confirmation" :value="errors.password_confirmation" />

                    </div>

                    <div class="col-span-full flex justify-end">
                        <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Add User
                        </JetButton>
                    </div>

                </div>
            </form>

        </template>
    </AppLayout>
</template>
