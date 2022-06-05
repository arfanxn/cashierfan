<template>

    <Head>
        <title>Test</title>
    </Head>

    <div class="">

        <button @click="post()">
            <ImgOrRandColor class="w-8 h-8" :payload="$page.props?.auth?.user?.details?.avatar" />
        </button>

        <h1>{{ $page.props.auth }}</h1>
    </div>

    <!-- <main class="flex items-center justify-center w-screen h-screen bg-gray-200"> -->
    <!-- <InputImage @onInput="img"></InputImage> -->

    <!-- <div class="flex gap-4">
        <input type="checkbox" id="check1" class="appearance-none checked:bg-blue-500 ..." />
        <label for="check1">C1</label>
        <input type="checkbox" id="check2" class="appearance-none indeterminate:bg-gray-300 ..." />
        <label for="check2">C2</label>
        <input type="checkbox" id="check3" class="default:ring-2 ..." />
        <label for="check3">C3</label>
    </div> -->

    <ButtonPagination :currentPage="1" nextPageURL="b" />
    <!-- </main> -->
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import ButtonPagination from "../Components/ButtonPagination.vue";
import InputImage from "../Components/InputImage.vue";
import { fetchAsJSON } from "../Mixins/Fetch";
import ImgOrRandColor from "../Components/ImgOrRandColor.vue";








function post() {
    fetchAsJSON("/test", {
        body: {}
    }).then(({ json, response }) => {

        console.log(response.status)

        console.log(response.headers.get('retry-after'));

        console.log(json);
    });

}

</script>