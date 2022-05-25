<template>
    <div class="flex items-center justify-center min-h-screen bg-teal-700">
        <div class="max-w-xl px-5 overflow-hidden bg-white border border-yellow-500 shadow-xl rounded-xl ">
            <header class="border-b py-2.5 bg-gray-100 flex justify-between items-center">
                <div class="">
                    <h1>Hello World</h1>
                    <span class="text-sm text-gray-500">Lorem, ipsum dolor.</span>
                </div>

                <v-button @onClick="fAlert">Lorem</v-button>
            </header>

            <main class="py-2 text-teal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam quae doloribus
                placeat dolor fuga quo.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum suscipit pariatur cupiditate expedita
                nisi quisquam consequatur, corporis repellendus eos est!
            </main>

            <footer class="border-t py-2.5 ">
                Lorem ipsum dolor sit amet consectetur adipisicing.
            </footer>
        </div>
    </div>
</template>

<script>
import Button from "../Components/Button.vue";

export default {
    components: {
        "v-button": Button
    },

    setup() {
        function fAlert() {
            console.log('Btn work heloo' + Date.now())
        }

        return { fAlert }
    }
}
</script>