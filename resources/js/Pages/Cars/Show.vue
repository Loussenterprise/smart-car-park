<template>
    <app-layout title="Show car">

         <div v-if="car">
        <div class="flex flex-wrap  align-middle items-center bg-white overflow-hidden rounded  py-6 px-4">

            <div class="sm:w-1/4 w-2/5 h-full  justify-left items-left align-middle rounded">

                <div class="w-fuhh box-border h-full text-center cursor-pointer"  @click="show">
                    <Link :href="car.image" target="_blank"  >
                        <img :src="car.image" alt="" class="w-full h-full">
                    </Link>
                </div> 
            </div>
            <div class="sm:w-1/2 sm:p-5 p-3 w-3/5 h-full   justify-left items-left align-middle rounded ">
                <table class="w-full h-full">
                    <tr>
                        <td>Nom</td>
                        <td><span class="font-bold text-lg">{{car.name}}</span></td>
                    </tr>
                    <tr v-if="car.type">
                        <td>Type</td>
                        <td> {{car.type}} </td>
                    </tr>
                    <tr>
                        <td>Nombre de siege</td>
                        <td>{{car.nbrsiege}}</td>
                    </tr>
                    <tr>
                        <td>Popularite</td>
                        <td>{{car.popularite}}</td>
                    </tr>
                    <tr>
                        <td>Consomation par heure</td>
                        <td>{{consombyhr}} L/h</td>
                    </tr>
                    <tr>
                        <td>Prix</td>
                        <td>{{car.prix}} F CFA / Jour</td>
                    </tr>
                </table>
                
            </div>
            <div class="sm:w-1/4 w-full h-full  rounded align-middle">
                <div  class="flex flex-wrap  justify-center items-center align-middle">
                    <Link :href="route('location.create',{'car_id':this.car.id})" class="bg-green-900 w-36 text-white text-center my-2 rounded p-3 mx-auto ">
                        Louer
                    </Link>
                </div>
                <div v-if="user!=null && user.is_admin==1" class="flex flex-wrap  items-center justify-between">
                    <div class=" bg-slate-900 text-white w-36 text-center   rounded my-2 mx-auto p-3">
                        <Link :href="route('car.update',{'id':this.car.id})">
                            Update
                        </Link>
                    </div>
                    <div class=" bg-red-600 text-white w-36  text-center   rounded my-2 mx-auto p-3">
                        <Link :href="route('car.delete',{'id':this.car.id})">
                            Delete
                        </Link>
                    </div>
                    <div class=" bg-blue-600 text-white w-36  text-center   rounded mx-auto my-2 p-3">
                        <Link :href="route('dashboard.cars')">
                            Dashboard.Cars
                        </Link>
                    </div>
                </div>
            </div>
            
        </div>
        <div v-if="locations!=null" class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            Liste des differents emprunts
            <div v-for="location in locations" v-bind:key="location.id" class="flex items-center space-x-4 bg-white overflow-hidden rounded rounded-b-none border-b-2 border-gray-200 py-6 px-4">
                <div class="w-1/3">Pris le : {{location.token_at}}</div>
                <div class="w-1/3">Rendu le : {{location.free_at}}</div>
                <div class="w-1/3">Par :  {{location.user.name}} <br/><a :href="'mailto:'+location.user.email">({{location.user.email}})</a></div>
            </div>
        </div>
         </div>
        <div v-else class="text-center mt-12">
            Rien a afficher
        </div>
    </app-layout>
</template>


<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({

        components: {
            Head,
            AppLayout,
            Link,
        },

        props: ['car','user','locations'],
    })
</script>
