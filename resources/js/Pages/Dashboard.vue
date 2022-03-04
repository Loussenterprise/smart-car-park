<template>
    <app-layout title="Dashboard" v-if="user.is_admin==0">
        <template #header>
            Locations
        </template>
        <div class="py-8 min-h-full ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-full " >
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-full">
                    <div class="justify-center items-center">
                        <div class="font-bold text-2xl">Locations en cours</div>
                        <div v-for="location in locations" v-bind:key="location.id">
                            <div v-if="location.closed!=1"  class="p-3">
                                <location-simple-show :location="location" />
                            </div>
                        </div>
                        <div class="mt-12 font-bold text-2xl">Locations cloture</div>
                        <div v-for="location in locations" v-bind:key="location.id">
                            <div v-if="location.closed==1"  class="p-3">
                                <location-simple-show :location="location" />
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </app-layout>

<!-- admins view -->

    <app-layout title="Dashboard" v-if="user.is_admin==1">
        <template #header>
            <Link :href="route('dashboard.users')"  :active="route().current('dashboard.users')" class="active p-2 m-2 rounded border-2 border-solid border-slate-600 hover:bg-slate-600 hover:text-white">
                Users
            </Link>
            <Link :href="route('dashboard.cars')" :active="route().current('dashboard.cars')" class="active p-2 m-2 rounded border-2 border-solid border-slate-600 hover:bg-slate-600 hover:text-white">
                Cars
            </Link>
            <Link :href="route('dashboard.locations')" :active="route().current('dashboard.locations')" class="active p-2 m-2 rounded border-2 border-solid border-slate-600 hover:bg-slate-600 hover:text-white">
                Locations
            </Link>
        </template>
        <div class="py-8 min-h-full ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-full " >
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-full">
                    <div class="justify-center items-center">


                    <div >
                        <div class="font-bold text-2xl">Locations en cours</div>
                        <div v-for="location in locations" v-bind:key="location.id">
                            <div v-if="location.closed!=1"  class="p-3">
                                <location-simple-show :location="location" />
                            </div>
                        </div>
                        <div class="mt-12 font-bold text-2xl">Locations cloture</div>
                        <div v-for="location in locations" v-bind:key="location.id">
                            <div v-if="location.closed==1"  class="p-3">
                                <location-simple-show :location="location" />
                            </div>
                        </div>
                    </div>

                        
                    
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Beti from '@/Layouts/Beti.vue'
    import Welcome from '@/Pages/Welcome.vue'
    import LocationSimpleShow from '@/Components/LocationSimpleShow.vue'
    import Link from '@/Jetstream/NavLink.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Beti,
            Welcome,
            LocationSimpleShow,
            Link,
        },
        props:['locations','user'],
    })
</script>
