<template>

    <Head>
        <title>Test</title>
    </Head>

    <main class="flex flex-col justify-center mx-96 space-y-4">
        <h1>{{ $page.props.auth }}</h1>
        <InputCurrency />
    </main>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { toIDR, toCurrency } from "../Helpers";
import InputCurrency from "../Components/InputCurrency.vue";

</script>