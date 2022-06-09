<template>
    <main class="relative">
        <div class="before:relative absolute left-0 right-0 z-10 top-0 transition duration-500 ease-in-out bg-white border rounded 
            border-slate-500" :class="props.classname">
            <slot name="header" v-if="props.title">
                <div class="flex justify-between px-2 py-1 items-start">
                    <div>
                        <span class="text-slate-700 text-base font-semibold">{{ props.title }}</span>
                    </div>
                    <div>
                        <button @click="close()">
                            <font-awesome-icon icon="fas fa-xmark" class="px-2 py-1 black" />
                        </button>
                    </div>
                </div>
            </slot>

            <ul @scroll="onScroll" @click.stop class="block overflow-y-auto max-h-52 py-8"
                :class="props.menuContainerClassname">

                <slot name="menu"></slot>
            </ul>
        </div>
    </main>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const emit = defineEmits(['onScroll', "onClose"]);

const props = defineProps({
    title: {
        required: false,
        type: String,
        default: "Title",
    },
    classname: {
        required: false,
        default: "",
    },
    menuContainerClassname: {
        required: false,
        default: "",
    }
});

function onScroll(event) {
    const isMaxBottom = event.target.scrollHeight - event.target.scrollTop === event.target.clientHeight;
    emit("onScroll", { payload: event, isMaxBottom });
}

function close() {
    emit("onClose");
}
</script>

