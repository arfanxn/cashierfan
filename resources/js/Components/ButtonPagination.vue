<template>
    <div class="flex items-center justify-between text-sm ">
        <ButtonLink v-if="pagination.firstPageURL && pagination.currentPage > 1" :href="pagination.firstPageURL"
            class="px-2 py-1 space-x-1 text-gray-500 transition duration-300 bg-white border rounded hover:bg-white/90 hover:text-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-50/25 focus:bg-white/90">
            <span class="inline-block md:hidden">1</span>
            <span class="hidden md:inline-block">First</span>
        </ButtonLink>
        <Button v-else disabled
            class="px-2 py-1 space-x-1 text-gray-500 transition duration-300 bg-white border rounded hover:bg-white/90 hover:text-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-50/25 focus:bg-white/90">
            <span class="inline-block md:hidden">1</span>
            <span class="hidden md:inline-block">First</span>
        </Button>

        <div class="flex items-center justify-center">
            <ButtonLink v-if="pagination.prevPageURL" :href="pagination.prevPageURL"
                class="px-2 py-1 space-x-1 text-gray-500 transition duration-300 bg-white border border-r-0 rounded-l hover:bg-white/90 hover:text-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-50/25 focus:bg-white/90">
                <font-awesome-icon icon="fas fa-angles-left"></font-awesome-icon>
                <span class="hidden lg:inline-block">Prev</span>
            </ButtonLink>
            <Button v-else disabled
                class="px-2 py-1 space-x-1 text-gray-500 transition duration-300 bg-white border border-r-0 rounded-l hover:bg-white/90 hover:text-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-50/25 focus:bg-white/90">
                <font-awesome-icon icon="fas fa-angles-left"></font-awesome-icon>
                <span class="hidden lg:inline-block">Prev</span>
            </Button>


            <Button disabled class="px-3 py-1 border-y">
                {{ pagination.currentPage }}
            </Button>


            <ButtonLink v-if="pagination.nextPageURL" :href="pagination.nextPageURL"
                class="px-2 py-1 space-x-1 text-gray-500 transition duration-300 bg-white border border-l-0 rounded-r hover:bg-white/90 hover:text-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-50/25 focus:bg-white/90">
                <span class="hidden lg:inline-block">Next</span>
                <font-awesome-icon icon="fas fa-angles-right"></font-awesome-icon>
            </ButtonLink>
            <Button v-else disabled
                class="px-2 py-1 space-x-1 text-gray-500 transition duration-300 bg-white border border-l-0 rounded-r hover:bg-white/90 hover:text-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-50/25 focus:bg-white/90">
                <span class="hidden lg:inline-block">Next</span>
                <font-awesome-icon icon="fas fa-angles-right"></font-awesome-icon>
            </Button>
        </div>
    </div>
</template>

<script setup>
import ButtonLink from "./ButtonLink.vue";
import Button from "./Button.vue";
import { setURIQueryString } from "../Helpers";
import { defineProps, reactive, computed } from "vue";

const props = defineProps({
    firstPageURL: {
        required: false,
        type: String,
        default: null,
    },
    prevPageURL: {
        required: false,
        type: String,
        default: null
    },
    currentPage: {
        required: true,
        type: Number
    },
    currentPageURL: {
        required: false,
        type: String,
        default: null
    },
    nextPageURL: {
        required: false,
        type: String,
        default: null
    }
});

const pagination = reactive({
    firstPageURL: computed(() => props.firstPageURL || setURIQueryString(
        props.currentPageURL || window.location.href, "page", 1) /**/),
    prevPageURL: computed(() => {
        if (props.currentPage > 1) {
            return props.prevPageURL || setURIQueryString(
                props.currentPageURL || window.location.href, "page",
                props.currentPage - 1);
        } else return null;
    }),
    currentPage: computed(() => props.currentPage),
    // currentPageURL: computed(() => props.currentPageURL),
    nextPageURL: computed(() => props.nextPageURL || setURIQueryString(
        props.currentPageURL || window.location.href, "page",
        props.currentPage + 1)),
})

</script>