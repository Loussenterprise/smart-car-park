<template>
    <app-layout title="welcome">
        <div v-if="cars.length" >
            <div class="flex flex-wrap justify-center items-center">
                <div v-for="car in cars" v-bind:key="car.id" class="p-3">

                    <car-simple-show :car="car" />
                    
                </div>

            </div>
            <div class="flex justify-center">
                
                <button class="my-3 bg-slate-600 text-slate-50 disabled rounded w-20" v-if="prev!=null">
                    <Link :href="route('welcome',{ 'more':this.prev })">
                            preview
                    </Link>
                </button>
                {{ count }}
                <button class="my-3 bg-slate-600 text-slate-50 rounded w-20"  v-if="more!=null">
                <Link :href="route('welcome',{ 'more':this.more })">
                        more
                </Link>
                </button>
                
            </div>
                
        </div>
        
        <div v-else>
            no car
            noth
        </div>

    </app-layout>
        
</template>

<script>
    import { defineComponent } from 'vue'
    import Beti from '@/Layouts/Beti.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import CarSimpleShow from '@/Components/CarSimpleShow.vue';

    export default defineComponent({
        components: {
            Head,
            Beti,
            AppLayout,
            CarSimpleShow,
            Link,
        },
        computed: {
            disa() {
                return this.prev<0
            },
            disb(){
                return this.more==-1
            }
        },

        props: {
            cars: Array,
            more: Number,
            prev: Number,
            count: Number,
        }
    })
</script>
