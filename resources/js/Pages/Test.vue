<template>
    <Head>
        <title>Test</title>
    </Head>

    <main class="flex flex-col justify-center space-y-4 mx-96">
        <h1>{{ $page.props.auth }}</h1>
        <h1>
            {{
                $page.props?.auth?.user?.permissions?.includes(`products.edit`)
            }}
        </h1>
        <InputCurrency />
    </main>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3';
// import { Inertia } from "@inertiajs/inertia";
// import { toIDR, toCurrency } from "../Helpers";
</script>
