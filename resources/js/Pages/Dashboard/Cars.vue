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
                                <div class="text-lg font-bold"> Liste des Voitures </div>
                                
                            </div>
                        </div>
                        <Link :href="route('car.create')">
                            <div class="p-4 flex justify-between cursor-pointer" @click="startCreate">
                                <div class="inline-flex items-center p-2 rounded border-2 border-solid border-blue-400 text-blue-700 font-bold hover:bg-blue-400 hover:text-white">Ajouter une voiture</div>  
                            </div>
                        </Link>
                            
                        <br/>
                        <table class=" w-full">
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Nombre de location</th>
                                <th>Libre</th>
                                <th>Actions</th>
                            </tr>
                            <tr v-for="car in cars" v-bind:key="car.id" class="pt-6">
                                <td><span class="w-20 h-20"><img :src="car.image" alt="" class="w-20 h-20"></span></td>
                                <td><div class="font-bold hover:text-blue-900 hover:bg-slate-100 cursor-pointer"><Link :href="route('car.show',{'id':car.id})"  class="text-black font-extrabold ">{{car.name}}</Link></div></td>
                                <td>{{car.type?car.type:'indefini'}}</td>
                                <td>{{car.popularite}}</td>
                                <td><span>{{user.free==1?'Oui':'Non'}}</span></td>
                                <td>
                                    <span class="bg-blue-600 text-white p-1 mx-2 rounded-full "><Link :href="route('car.update',{'id':car.id})" class="text-white">Update</Link></span>
                                    <span class="bg-red-600 text-white   p-1 mx-2 rounded-full  "><Link :href="route('car.delete',{'id':car.id})" class="text-white">Delete</Link></span>
                                </td>
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
        props:['cars','user'],
    })
</script>
