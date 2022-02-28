<template>
    <div class="w-full py-3 bg-white px-4">
        <label for="search" class="hidden">Search</label>
        <input
            id="search"
            ref="search"
            v-model="search"
            class="transition h-10 w-full bg-gray-100 border border-gray-500 rounded-full focus:border-purple-400 outline-none cursor-pointer text-gray-700 px-4 pb-0 pt-px"
            :class="{ 'transition-border': search }"
            autocomplete="off"
            name="search"
            placeholder="Search"
            type="search"
            @keyup.esc="search = null"
            @blur="search = null"
        />
    </div>
</template>
 
<script>
    import { defineComponent } from "vue";
 
    export default defineComponent({
        props: {
            // any route name from laravel routes (ideally index route is what you'd search through)
            routeName: String,
        },
 
        data() {
            return {
                // page.props.search will come from the backend after search has returned.
                search: this.$inertia.page.props.search || null,
            };
        },
 
        watch: {
            search() {
                if (this.search) {
                    // if you type something in the search input
                    this.searchMethod();
                } else {
                    // else just give us the plain ol' paginated list - route('stories.index')
                    this.$inertia.get(route(this.routeName));
                }
            },
        },
 
        methods: {
            searchMethod: _.debounce(function () {
                this.$inertia.get(
                    route(this.routeName),
                    { search: this.search },
                    { preserveState: true }
                );
            }, 500),
        },
    });
</script>