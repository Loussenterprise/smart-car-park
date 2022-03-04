<template>
    <div v-if="car" class="min-w-max w-60 bg-slate-200 items-center justify-between pt-3 mb-3">
        <div class="w-52 mx-auto my-2 box-border bg-white h-52 text-center cursor-pointer"  @click="show">
            <img :src="car.image" alt="">
        </div>   
        <div class="items-center justify-center">
            <div class="text-xl text-center">
                {{car.name}}
            </div>
            <div class="text-sm text-center">
                {{car.nbrsiege}} Sieges
            </div>
            <div class=" text-center">
                {{car.prix}} F CFA
            </div>
        </div>
        

    </div>
</template>


<script>

    import { defineComponent } from "vue";

    export default defineComponent ({
        props: ['car','locations'],

        methods: {
            show () {
                this.$inertia.get(
                    route("car.show",{'id':this.car.id})
                );
            },
        },
    });
</script>