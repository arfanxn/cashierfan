<template>
    <Input type="text" @blur="throwEmit" @input="onInput" @keyup.enter="throwEmit" />
</template>

<script setup>
import Input from "./Input.vue";
import { toCurrency } from "../Helpers";
import { onMounted, reactive, defineEmits } from "vue";
const emit = defineEmits(['onInput', "onBlur", "onKeyup"]);

function onInput(event) {
    let value = event.target.value;
    const exceptNumericNCommaNDot = /[^0-9,\.]+/ig;
    if (exceptNumericNCommaNDot.test(value)) {
        value = value.replace(exceptNumericNCommaNDot, "");
    }

    event.target.value = value.replace(/[,]+\,*/ig, ",").replace(/[\.]+\.*/ig, ".");

    emit(`onInput`, { payload: event.target, value, });
}

function throwEmit(event) {
    event.target.value = toCurrency(event.target.value).withoutSymbol;

    const eventType = "on" + event.type.charAt(0).toUpperCase() + event.type.slice(1);

    emit(eventType, { payload: event.target, value: event.target.value, });
}
</script>