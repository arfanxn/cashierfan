<template>
    <div class="flex items-center py-3 mt-10 border-t-2 border-slate-500/25">
        <h1 class="font-light text-slate-700">
            <span class="font-semibold">{{
                $inertia.page.props?.app?.name
            }}</span>
            &copy;{{ tap(new Date(), (date) => date.getFullYear()) }} |
            <a href="https://arfanxn.github.io" class="underline">Arfanxn</a>
        </h1>
    </div>
</template>

<script setup>
import { tap } from '../Helpers';
</script>
