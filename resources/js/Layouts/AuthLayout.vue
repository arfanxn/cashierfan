<template>
    <main class="">
        <Sidebar />
        <Navbar />

        <div class="absolute bottom-0 left-0 right-0 z-10 p-2 top-12 lg:p-8">
            <slot></slot>
            <Footer />
        </div>




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