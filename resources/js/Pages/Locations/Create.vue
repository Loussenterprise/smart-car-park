<template>
    <app-layout title="Create new car">
        <div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="text-lg text-center ">
                    Rent a car
                    <div class="flex justify-center items-center mx-auto">
                        <car-simple-show :car="car" />
                    </div>
                </div>
                <form @submit.prevent="create" v-if="car.free==1">
                    Prix total : {{ tp() }} F CFA
                    <jet-input id="car_id" type="hidden"  v-model="form.car_id" required />
                    <jet-input id="user_id" type="hidden"  v-model="form.user_id" required />
                    <div class=" mt-4">
                        <jet-label for="token_at" value="token_at" />
                        <jet-input id="token_at" type="datetime-local" class="mt-1 block w-full" v-model="form.token_at" required autofocus />
                    </div>
                    <div class=" mt-4">
                        <jet-label for="duration" value="duration" />
                        <div class="flex mr-2 items-center"><jet-input id="duration" type="number" min=0 class="mt-1 block w-20" v-model="form.duration" required autofocus /> Jours</div>
                    </div>
                    <!-- <div class=" mt-4">
                        <jet-label for="free_at" value="free_at" />
                        <jet-input id="free_at" type="datetime-local" class="mt-1 block w-full" v-model="form.free_at" disabled />
                    </div> -->
                    Prix total : {{ tp() }} F CFA
                    <div class=" flex justify-end mt-4">
                        <jet-button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </jet-button>
                    </div>
                </form>
                <div v-else class="flex justify-between">
                    <div class="justify-start">Voiture en location</div>
                    <div class="justify-end cursor-pointer bg-slack-600" @click="show" >Retour</div>
                    
                </div>
            </div>
        </div>
        
        
    </app-layout>
        
</template>


<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import CarSimpleShow from '@/Components/CarSimpleShow.vue';

    export default defineComponent({
        components: {
            Head,
            JetButton,
            JetInput,
            JetLabel,
            AppLayout,
            CarSimpleShow,
            Link,
        },

        props: ['car','totalprice','user','token_at','free_at'],


        data() {
            return {
                form: this.$inertia.form({
                    car_id: this.car.id,
                    user_id: this.user.id,
                    token_at: this.token_at,
                    duration: 1,
                })
            }
        },

        methods: {
            create() {
                this.form
                    .transform(data => ({
                        ... data,
                    }))
                    .post(this.route('location.store'))
            },
            updateFreeAt(){
                

            },
            tp(){
                return this.totalprice*this.form.duration
            },
            show () {
                this.$inertia.get(
                    route("car.show",{'id':this.car.id})
                );
            },
        },
    })
</script>
