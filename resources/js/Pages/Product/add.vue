<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ErrorLabel from '@/Components/ErrorLable.vue';

const form = useForm({
    name: '',
    price: ''
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
                        <Link href="/products">Product Management </Link> \ Add Product
                    </h2>
                </div>
            </div>
        </template>

        <template #body>
            <form @submit.prevent="form.post(route('products.store'))">
                <div class="grid grid-cols-6 gap-6 md:grid-cols-12">

                    <div class="col-span-6 mt-4">
                        <JetLabel for="name" value="Name" />
                        <JetInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.name" :value="errors.name" />

                    </div>
                    <div class="col-span-6 mt-4">
                        <JetLabel for="price" value="Price" />
                        <JetInput
                            id="price"
                            v-model="form.price"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <ErrorLabel v-if="errors.price" :value="errors.price" />

                    </div>

                    <div class="col-span-full flex justify-end">
                        <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Add Product
                        </JetButton>
                    </div>
                    
                </div>
            </form>

        </template>
    </AppLayout>
</template>
