<template>
    <main class="p-2 lg:p-8">
        <slot></slot>
    </main>
</template>


<script setup>
import Sidebar from "../Components/Sidebar.vue"
import Navbar from "../Components/Navbar.vue"
import Footer from "../Components/Footer.vue"

import { defineComponent, onMounted } from "vue"

const components = defineComponent({ Navbar, Sidebar, Footer });

onMounted(() => {
    document.body.classList.add('bg-gray-200/50')
})
</script>