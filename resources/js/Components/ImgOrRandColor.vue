<template>
    <img v-if="props.payload.length > 7 && !props.payload.includes('#')"
        class="w-full h-full bg-center bg-no-repeat bg-cover aspect-square" :src="props.payload" />
    <main v-else class="w-full h-full" :style="{ backgroundColor: props.payload || randColor }">
        <slot></slot>
    </main>
</template>

<script setup>
import { defineProps } from "vue";
import { randChars } from "../Helpers";

const randColor = "#" + randChars(6, "0123456789ABCDEF")

const props = defineProps({
    payload: {
        default: null,
        required: false
    }
});

</script>