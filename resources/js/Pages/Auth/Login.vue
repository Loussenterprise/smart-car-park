<template>
    <!-- <app-layout title="Log in"> -->
        <jet-authentication-card>
            <template #logo>
                <jet-authentication-card-logo />
            </template>

            <jet-validation-errors class="mb-4" />

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="email" value="Email" />
                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
                </div>

                <div class="mt-4">
                    <jet-label for="password" value="Password" />
                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <jet-checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center mt-4 w-full justify-between">
                    <Link  :href="route('register')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-4 justify-start bg-slate-500">
                        Register
                    </Link>

                    <div class=" justify-end">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                            Forgot your password?
                        </Link>

                        <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </jet-button>
                    </div>
                </div>
            </form>
        </jet-authentication-card>
    <!-- </app-layout> -->
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            AppLayout,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            },
            register() {
                this.$inertia.get(route('register'));
            }
        }
    })
</script>
