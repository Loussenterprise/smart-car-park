<template>

        <Head title="Acess error" />
    <div class="w-screen h-screen justify-center items-center align-middle">
        <div class="text-red-700 text-3xl mx-auto text-center">{{error}}</div>
        <Link :href="route('welcome')" class="text-blue-700 cursor-pointer ">
            RETURN TO HOME
        </Link>
    </div>
        
</template>


<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: ['error'],


        methods: {
            home () {
                this.$inertia.get(
                    route("welcome")
                );
            },
        },
    })
</script>
