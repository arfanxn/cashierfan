<template>
    <main
        class="flex flex-col items-center justify-center w-full min-h-screen p-2 lg:p-8 gap-2 md:gap-4"
    >
        <div
            class="flex flex-col items-center justify-center rounded-full p-6 bg-indigo-900/[.125]"
        >
            <img
                class="w-20 h-20 md:w-24 md:h-24"
                src="/images/brands/icons/cashier-machine-gray-blue-256px.png"
                alt=""
            />
            <h1 class="text-slate-700 text-xl font-bold lg:text-2xl">
                {{ $inertia.page.props?.app?.name }}
            </h1>
        </div>
        <slot></slot>
    </main>
</template>

<script setup>
import Sidebar from '../Components/Sidebar.vue';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';

import { defineComponent, onMounted } from 'vue';

const components = defineComponent({ Navbar, Sidebar, Footer });

onMounted(() => {
    document.body.classList.add('bg-gray-200/50');
});
</script>
