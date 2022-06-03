<template>
    <button @click="event => emit('onClick', { event, data: props.data })" type="button"
        @submit="event => emit('onSubmit', { event, data: props.data })"
        class="text-white transition duration-300 bg-indigo-900 hover:bg-indigo-900/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-indigo-900/25 focus:bg-indigo-900/90">
        <slot>button</slot>
    </button>
</template>


<script setup>
import { defineEmits, defineProps } from "vue";
const props = defineProps({
    data: {
        required: false,
        default: null,
    }
})
const emit = defineEmits(['onClick', 'onSubmit']);

</script>

