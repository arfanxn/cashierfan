<template>
    <div :class="`before:${colorAccent} ${colorAccent}`"
        class="overflow-hidden border shadow rounded-xl before:pt-2 before:rounded-t before:block ">
        <header class="flex items-center px-5 py-2 space-x-2 border-b rounded-t-lg bg-neutral-100">
            <slot name="title">
                <font-awesome-icon icon="fas fa-font-awesome"></font-awesome-icon>
                <h1 class="font-semibold">Lorem, ipsum dolor.</h1>
            </slot>
        </header>

        <main class="h-full px-5 py-2 bg-white rounded-b-xl">
            <slot>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque error natus id aliquid dolor cum
                architecto ut expedita aperiam odio?</slot>
        </main>
    </div>
</template>

<script>
export default new class {
    props = {
        colorAccent: {
            required: false,
            type: String,
            default: "bg-indigo-900"
        }
    };

    setup({ colorAccent }) {

        return { colorAccent }
    }
}
</script>