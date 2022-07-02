<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';

defineProps({
    title: String,
});

// const showingNavigationDropdown = ref(false);

// const switchToTeam = (team) => {
//     Inertia.put(route('current-team.update'), {
//         team_id: team.id,
//     }, {
//         preserveState: false,
//     });
// };

// const logout = () => {
//     Inertia.post(route('logout'));
// };
</script>

<template>
    <div>
        <Head :title="title" />
        <div class="bg-white pl-4 pr-6 py-2">
            <div class="h-14">
                <div class="flex">
                    <div class="py-2 w-64 flex gap-2">
                        <AuthenticationCardLogo />
                        <h1 class="text-2xl font-bold leading-5 text-violet-900 sm:text-2xl sm:truncate">PHARMACY</h1>
                    </div>
                    <div> </div>
                </div>
            </div>

            <div class="flex">
                <div class="w-64 min-h-screen">
                    <div class="w-48 text-gray-900">
                        <button type="button" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-violet-200 rounded-lg hover:bg-violet-100 hover:violet-blue-900 focus:z-10 focus:bg-violet-200 focus:text-violet-900 focus:font-bold">
                            Users
                        </button>
                        <button type="button" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-violet-200 rounded-lg hover:bg-violet-100 hover:violet-blue-900 focus:z-10 focus:bg-violet-200 focus:text-violet-900 focus:font-bold">
                            Products
                        </button>
                        <button type="button" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-violet-200 rounded-lg hover:bg-violet-100 hover:violet-blue-900 focus:z-10 focus:bg-violet-200 focus:text-violet-900 focus:font-bold">
                            Prescription
                        </button>
                    </div>
                </div>
                <div class="w-full min-h-screen bg-violet-100 p-4 rounded-md">
                    <div class="w-full bg-white rounded-md p-4">
                        
                        <slot name="header" />
                        <hr class="mt-1"/>
                        <slot name="body" />

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
