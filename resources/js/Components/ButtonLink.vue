<template>
    <Link
        class="text-white transition duration-300 bg-indigo-900 hover:bg-indigo-900/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-indigo-900/25 focus:bg-indigo-900/90">
    <slot>Link</slot>
    </Link>
</template>


<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: { Link },

    setup() {
    }
}
</script>

