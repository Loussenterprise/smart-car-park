<template>
    <app-layout title="Create new car">
        <div class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="text-lg text-center ">
                    Update car
                </div>
                <form @submit.prevent="update"  enctype="multipart/form-data">
                    <jet-input id="id" type="hidden"  v-model="form.id" required />
                    <div class=" mt-4">
                        <jet-label for="name" value="Nom" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
                    </div>
                    <div class=" mt-4">
                        <jet-label for="nbrsiege" value="nbrsiege" />
                        <jet-input id="nbrsiege" type="number" class="mt-1 block w-full" v-model="form.nbrsiege" required autofocus />
                    </div>
                    <div class=" mt-4">
                        <jet-label for="nbrroue" value="nbrroue" />
                        <jet-input id="nbrroue" type="number" class="mt-1 block w-full" v-model="form.nbrroue" required autofocus />
                    </div>
                    <div class=" mt-4">
                        <span>Taille en mettre</span><br/>
                        <div class="flex">
                            <div class="block">
                                <jet-label for="width" value="width" />
                                <jet-input id="width" type="number" class="mt-1 block w-full" v-model="form.width" required autofocus />
                            </div>
                            <div class="block mx-2">
                                <jet-label for="length" value="length" />
                                <jet-input id="length" type="number" class="mt-1 block w-full" v-model="form.length" required autofocus />
                            </div>
                            <div class="block">
                                <jet-label for="height" value="height" />
                                <jet-input id="height" type="number" class="mt-1 block w-full" v-model="form.height" required autofocus />
                            </div>
                                
                        </div>
                    </div>
                    <div class=" mt-4">
                        <jet-label for="consombyhr" value="consombyhr" />
                        <jet-input id="consombyhr" type="number" class="mt-1 block w-full" v-model="form.consombyhr" required autofocus />
                    </div>
                    <div class=" mt-4">
                        <jet-label for="prix" value="prix" />
                        <jet-input id="prix" type="number" class="mt-1 block w-full" v-model="form.prix" required autofocus />
                    </div>
                    <div class=" mt-4">
                        <jet-label for="image" value="image" />
                        <input id='image' type="file" @input="form.image = $event.target.files[0]"  required autofocus  />
                    </div>
                    <div class=" flex justify-end mt-4">
                        <jet-button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Update
                        </jet-button>
                    </div>
                    
                </form>
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
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetButton,
            JetInput,
            JetLabel,
            AppLayout,
            Link,
        },

        props: {
            car: Object,
        },

        data() {
            return {
                form: this.$inertia.form({
                    id: this.car.id,
                    name: this.car.name,
                    image: null,
                    nbrsiege: this.car.nbrsiege,
                    nbrroue: this.car.nbrroue,
                    width: this.car.width,
                    length: this.car.length,
                    height: this.car.height,
                    prix: this.car.prix,
                    consombyhr: this.car.consombyhr,
                })
            }
        },


        methods: {
            update() {
                this.form.post(this.route('car.perform_update',{ 'id' : this.car.id }))
            },
        }
    })
</script>
