<template>
    <main class="">
        <Sidebar>
            <Navbar />
            <div class="p-8">
                <slot></slot>
            </div>
        </Sidebar>
    </main>
</template>


<script setup>
import Sidebar from "../Components/Sidebar.vue"
import Navbar from "../Components/Navbar.vue"

import { defineComponent, onMounted } from "vue"

const components = defineComponent({ Navbar, Sidebar });

onMounted(() => {
    document.body.classList.add('bg-gray-200/50')
})
</script>