<template>

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
                        <div class="justify-center items-center">

                            <div class="text-center">
                                <div class="text-lg font-bold"> Liste des Locations </div>
                                
                            </div>
                        </div>
                        <br/>
                        <table class=" w-full">
                            <tr>
                                <th>Voiture</th>
                                <th>Utilisateur</th>
                                <th>Duree</th>
                                <th>Drix</th>
                                <th>Debut</th>
                                <th>Fin</th>
                                <th>Actions</th>
                            </tr>
                            <tr v-for="location in locations" v-bind:key="location.id" class="pt-5 h-10">
                                <td><Link :href="route('car.show',{'id':location.car.id})"  class="text-black font-extrabold ">{{location.car.name}}</Link></td>
                                <td>{{location.user.name}}</td>
                                <td>{{location.duration}} Jours</td>
                                <td>{{location.prix}}</td>
                                <td>{{location.token_at}}</td>
                                <td>{{location.free_at}}</td>
                                <td><span v-if="!location.closed" class="bg-blue-600 text-white p-1 mx-2 rounded-full "><Link :href="route('location.close',{'id':location.id})" class="text-white">Cloturer</Link></span></td>
                            </tr>
                        </table>
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
