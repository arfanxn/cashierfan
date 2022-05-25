<template>
    <button @click="$emit('onClick')"
        class="px-3 py-1.5 font-semibold text-white transition duration-300 bg-gray-500 rounded-xl hover:bg-gray-300 hover:text-black focus:outline-none focus:ring focus:ring-gray-400">
        <slot>Button</slot>
    </button>
</template>


<script>
export default {

    setup() {
    }

}
</script>

