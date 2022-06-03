<template>
    <textarea @click="event => emit(`onInput`, {
        payload: event.target, value: event.target.value,
    })" @change="event => emit(`onChange`, {
    payload: event.target, value: event.target.value,
})" class="w-full px-2 py-1 border file:text-slate-600 focus:outline-none focus:outline-indigo-900/25 focus:outline-4 focus:outline-offset-0 "
        rows="2"></textarea>
</template>

<script setup>
import { defineEmits, } from 'vue';
const emit = defineEmits(['onInput', "onChange"]);
</script>