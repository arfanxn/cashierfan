<template>
    <Card colorAccent="bg-blue-500">
        <template v-slot:title>
            <font-awesome-icon icon="fas fa-box-open"></font-awesome-icon>
            <h1 class="font-semibold">PRODUCT STOCKS</h1>
        </template>

        <div class="py-3">
            <div class="flex">
                <Input placeholder="Search products" class="rounded-l" type="text" />

                <Button class="px-2 rounded-r">
                    <font-awesome-icon icon="fas fa-magnifying-glass"></font-awesome-icon>
                </Button>
            </div>

            <div class="mt-4 overflow-hidden border rounded">
                <div class="flex justify-between px-3 py-2 border-b "
                    v-for="(item, index) in [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]" :key="index">

                    <p class="font-semibold"><span class="font-normal">{{ index + 1 }}. </span> Lorem
                        ipsum
                    </p>

                    <p
                        class="flex items-center justify-center w-6 h-6 text-sm font-semibold text-white bg-red-500 rounded-full">
                        20</p>

                </div>
            </div>

        </div>

    </Card>
</template>

<script>
import Card from "../Card.vue"
import Input from "../Input.vue"
import Button from "../Button.vue";

export default {
    components: { Card, Input, Button },

}
</script>