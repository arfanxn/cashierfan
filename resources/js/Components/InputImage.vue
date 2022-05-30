<template>
    <main class="block w-full h-full bg-center bg-no-repeat bg-cover" @click="selectImg"
        :style="{ backgroundImage: `url(${previewImgURL})` }">
        <!-- <img :src="previewImgURL" class="w-full h-full" v-show="previewImgURL" alt=""> -->
        <button :class="{ 'invisible': previewImgURL }" class="w-full h-full" @click="selectImg">
            <Input :class="{ 'hidden': hasSlot('default') }" :id="inputImgID" type="file" class="w-full h-full rounded"
                @onInput="readImgNThrowEmit" />

            <slot />
        </button>
    </main>
</template>

<script setup>
import Input from "./Input.vue";
import { ref, defineEmits, defineProps, watch, useSlots } from "vue";
import { imgValidation, randInt } from "../Helpers";

const emit = defineEmits(['onInput', "onError"]);
const slots = useSlots();
const hasSlot = (name) => !!slots[name];


const props = defineProps({
    previewImgURL: {
        required: false, default: null, type: String
    }
})
const previewImgURL = ref(props.previewImgURL || null);
const inputImgID = "inputImg" + randInt(1000, 9999) + Date.now(); // generate random ID for the input image

watch(() => props.previewImgURL, newVal => {
    previewImgURL.value = newVal;
})


function selectImg() {
    document.getElementById(inputImgID).click();
}
function readImgNThrowEmit({ files }) {
    // check file is exist and file type is image 
    console.log(files);

    if (!files || !imgValidation(files[0]['name'])) {
        return emit("onError", { message: "File is not a valid image!" });
    }

    // preview the image
    let reader = new FileReader
    reader.onload = e => {
        previewImgURL.value = e.target.result
    }
    reader.readAsDataURL(files[0])

    // throw emit to the parent
    emit('onInput', { files, file: files[0] });

}
</script>
