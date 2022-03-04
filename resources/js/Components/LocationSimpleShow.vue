<template>
                <div v-if="location" class="flex items-center space-x-4 bg-white overflow-hidden rounded rounded-b-none border-b-2 border-gray-200 py-6 px-4">
                    <img class="h-16 w-16 object-cover rounded-full" :src="location.car.image">
                    <div class="flex flex-col w-2/3">
                        <div>
                            <a class="text-xl to-blue-700 text-gray-900 font-bold hover:text-blue-400" :href="`/cars/show/${location.car.id}`">
                                {{ location.car.name }}
                            </a>
                            <!-- <span class="font-thin text-gray-400"> : <em>{{ sale.type }}</em> </span> -->
                        </div>
                        <div class="text-sm text-gray-400 font-thin" v-if="location.car.free==1">libre</div>
                        <div  class="text-sm text-gray-400 font-thin" v-else><em>Loue par : </em>{{ location.user.name }} </div>
                        <!-- <a v-if="location.car.free==1" class="bg-white text-blue-500 cursor-pointer px-5 py-2 hover:text-white border border-blue-500 leading-tight hover:bg-blue-500 rounded-full font-extrabold transition-all duration-300" :href="`reserve/${location.car.id}`" >louer</a> -->
                        <div  class="items-left" style="text-align:left;">
                            Le: {{ location.token_at }} <br/>
                            Pour: {{ location.duration }} <br/>
                            Rendu : {{ location.free_at }} <br/>
                            <span v-if="location.closed" >Cloture</span>
                        </div>
                    </div>
                        <div class="align-middle">
                            <div v-if="location.car.free">
                                <button class="rounded bg-slate-800 text-white p-3 text-lg" @click="rent">Reserver</button>
                            </div>
                            <div  v-if="!location.closed">
                                <button class="rounded bg-slate-800 text-white p-3 text-lg" @click="rendre">Rendre</button>
                            </div>
                            
                        </div>
                    
                    
                </div>
</template>


<script>

    import { defineComponent } from "vue";

    export default defineComponent ({
        props: ['location'],

        methods: {
            show () {
                this.$inertia.get(
                    route("car.show",{'id':this.location.car.id})
                );
            },
            rent () {
                this.$inertia.get(
                    route("location.create",{'car_id':this.location.car.id})
                );
            },
            rendre () {
                this.$inertia.get(
                    route("location.close",{'id':this.location.id})
                );
            },
        },
    });
</script>