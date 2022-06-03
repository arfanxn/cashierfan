<template>
    <input
        class="w-full px-2 py-1 border border-gray-300 file:text-slate-600 focus:outline-none focus:outline-indigo-900/25 focus:outline-4 focus:outline-offset-0 file:mr-2 file:py-1 lg:file:px-4 file:px-2 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-100/50 hover:file:bg-indigo-300/50"
        type="text" @input="throwEmit">
</template>

<script setup>
import { defineEmits, } from 'vue';
const emit = defineEmits(['onInput'])


function throwEmit(event) {
    const payload = event.target;
    const files = "files" in payload && payload?.files?.length > 0 ? payload.files : null;

    if (files) {  // if the input type is file then we need to send the emit among the files
        emit(`onInput`, {
            payload, value: payload.value, files, file: files[0],
        })
    } else {
        emit(`onInput`, {
            payload, value: payload.value,
        })
    }

}
</script>


