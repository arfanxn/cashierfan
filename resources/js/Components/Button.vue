<template>
    <button @click="$emit('onClick')"
        class="text-white transition duration-300 bg-indigo-900 hover:bg-indigo-900/90 hover:text-white focus:outline-none focus:ring focus:ring-indigo-900/25 focus:bg-indigo-900/90">
        <slot>Button</slot>
    </button>
</template>


<script>
export default {

    setup() {
    }

}
</script>

