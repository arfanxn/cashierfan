<template>
    <div v-show="alert.isShow && alert.message" :class="alert.classList"
        class="flex items-center justify-between px-2 py-1 space-x-1 rounded lg:space-x-3 md:space-x-3">
        <div class="w-full ">
            {{ alert.message }}
        </div>
        <button type="button" @submit.prevent @click="close()">
            <font-awesome-icon icon="fas fa-xmark" class="text-black"></font-awesome-icon>
        </button>
    </div>
</template>

<script setup>
import { defineProps, watch, reactive, onMounted, defineEmits } from "vue";

const emit = defineEmits(['onClose']);

const props = defineProps({
    type: {
        default: "error",
        required: false,
        type: String,
    },
    message: {
        default: ``,
        required: true,
    },
})

const alert = reactive({
    type: '',
    message: '',
    classList: "",
    isShow: false,
});

watch(() => props, () => {
    initialize()
}, { deep: true });
onMounted(() => {
    initialize()
})

function initialize() {
    alert.type = props.type;
    alert.message = props.message;

    switch (alert.type) {
        case 'success':
            alert.classList = ' bg-green-200 text-green-700 ';
            break;
        case 'question':
        case 'info':
            alert.classList = ' bg-blue-200 text-blue-700 ';
            break;
        case 'error':
        case 'errors':
        default:
            alert.classList = ' bg-red-200 text-red-700 ';
            break;
    }

    if (alert.message) show();
}

function show() {
    alert.isShow = true;
}

function close() {
    alert.message = ``;
    alert.isShow = false;
    emit("onClose");
}
</script>