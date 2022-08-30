<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import AuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import SidePanel from '../Layouts/SidePanel.vue';


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

const logout = () => {
    Inertia.post(route('logout'));
};
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

                    <div class="flex justify-end w-full px-1"> 
                        <div v-if="$page.props.user.name">
                            <h1 class="text-xl font-bold leading-5 text-violet-900 sm:text-xl sm:truncate mt-3 mr-4">{{ $page.props.user.name }}</h1>
                        </div>
                         <div class="my-auto" @click="logout">
                            <AuthenticationCardLogo />
                        </div>
                    </div>     

                </div>
            </div>

            <div class="flex">

                <div class="w-64 min-h-screen">
                    <SidePanel />
                </div>

                <div class="w-full min-h-screen bg-violet-100 p-4 rounded-md">
                    <div class="w-full bg-white rounded-md p-4">

                        <slot name="header" />

                        <hr class="mt-5 mb-10 border-violet-300 shadow shadow-violet-300"/>

                        <slot name="body" />

                    </div>
                </div>

            </div>

        </div>
        <div class="fixed bottom-5 right-6 rounded-lg flex gap-4 items-center bg-green-500 transp text-white text-sm font-bold px-4 py-3"
             v-if="$page.props.flash.message"
             role="alert">
            <svg class="h-7 w-7" viewBox="0 0 117 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g fill-rule="nonzero" id="correct"><path d="M34.5,55.1 C32.9,53.5 30.3,53.5 28.7,55.1 C27.1,56.7 27.1,59.3 28.7,60.9 L47.6,79.8 C48.4,80.6 49.4,81 50.5,81 C50.6,81 50.6,81 50.7,81 C51.8,80.9 52.9,80.4 53.7,79.5 L101,22.8 C102.4,21.1 102.2,18.5 100.5,17 C98.8,15.6 96.2,15.8 94.7,17.5 L50.2,70.8 L34.5,55.1 Z" fill="#17AB13" id="Shape"/><path d="M89.1,9.3 C66.1,-5.1 36.6,-1.7 17.4,17.5 C-5.2,40.1 -5.2,77 17.4,99.6 C28.7,110.9 43.6,116.6 58.4,116.6 C73.2,116.6 88.1,110.9 99.4,99.6 C118.7,80.3 122,50.7 107.5,27.7 C106.3,25.8 103.8,25.2 101.9,26.4 C100,27.6 99.4,30.1 100.6,32 C113.1,51.8 110.2,77.2 93.6,93.8 C74.2,113.2 42.5,113.2 23.1,93.8 C3.7,74.4 3.7,42.7 23.1,23.3 C39.7,6.8 65,3.9 84.8,16.2 C86.7,17.4 89.2,16.8 90.4,14.9 C91.6,13 91,10.5 89.1,9.3 Z" fill="#4A4A4A" id="Shape"/></g></g></svg>
            <p>{{ $page.props.flash.message }}</p>
        </div>
    </div>
</template>
