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


                    <div class="text-center">
                        <div class="text-lg font-bold"> Liste des utilinateurs </div>
                        
                    </div>
                    </div>
                    
                        <div class="p-4 flex justify-between cursor-pointer" @click="startCreate">
                                <div class="inline-flex items-center p-2 rounded border-2 border-solid border-blue-400 text-blue-700 font-bold hover:bg-blue-400 hover:text-white" >Ajouter un utilisateur</div>  
                        </div>
                        <br/>
                        <table class=" mx-4 w-full">
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="user in users" v-bind:key="user.id"  class="pt-5 h-10">
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td><span>{{user.is_admin==1?'Oui':'Non'}}</span></td>
                                <td><span class="bg-blue-600 text-white p-1 mx-2 rounded-full ">Update</span><span class="bg-red-600 text-white   p-1 mx-2 rounded-full  ">Delete</span></td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="creatingUser" @close="closeModal">
                <template #title>
                    Ajouter un utilisateur
                </template>

                <template #content>
                    Entrez les informations
                    
            <div>
                <jet-label for="name" value="Name" />
                <jet-input id="name" ref='name' type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" ref="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="is_admin" value="Administrateur" />
                <jet-checkbox name="is_admin" id="is_admin" v-model:checked="form.is_admin" />
            </div>

                    <!-- <div class="mt-4">
                        <jet-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter="logoutOtherBrowserSessions" />

                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div> -->
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-3" @click="create" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Ajouter
                    </jet-button>
                </template>
            </jet-dialog-modal>

    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Beti from '@/Layouts/Beti.vue'
    import Welcome from '@/Pages/Welcome.vue'
    import LocationSimpleShow from '@/Components/LocationSimpleShow.vue'
    import Link from '@/Jetstream/NavLink.vue'
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetLabel from '@/Jetstream/Label.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Beti,
            Welcome,
            LocationSimpleShow,
            Link,
            JetDialogModal,
            JetInputError,
            JetSecondaryButton,
            JetInput,
            JetCheckbox,
            JetButton,
            JetLabel,
        },
        props:['users','user'],


        data() {
            return {
                creatingUser: false,

                form: this.$inertia.form({
                    name: '',
                    email: '',
                    is_admin: false,
                    password: '',
                    password_confirmation: '',
                }),
            }
        },

        methods: {
            startCreate() {
                this.creatingUser = true

                setTimeout(() => this.$refs.name.focus(), 250)
            },

            create() {
                this.form.post(route('add_new_user'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },

            closeModal() {
                this.creatingUser = false

                this.form.reset()
            },
        },
    })
</script>
