<template>
    <div :class="`before:${colorAccent} ${colorAccent}`"
        class="overflow-hidden border shadow rounded-xl before:pt-2 before:rounded-t before:block ">
        <header v-if="hasSlot('title')"
            class="flex items-center px-4 py-2 space-x-2 border-b rounded-t-lg bg-neutral-100">
            <slot name="title">
            </slot>
        </header>

        <main class="h-full px-5 py-2 bg-white rounded-b-xl">
            <slot></slot>
        </main>
    </div>
</template>

<script setup>
import { defineProps, useSlots } from 'vue';

const props = defineProps({
    colorAccent: {
        required: false,
        type: String,
        default: "bg-indigo-900"
    }
});

const slots = useSlots()
const hasSlot = (name) => !!slots[name];



</script>