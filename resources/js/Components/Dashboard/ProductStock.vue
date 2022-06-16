<template>
    <Card colorAccent="bg-blue-500">
        <template v-slot:title>
            <font-awesome-icon icon="fas fa-box-open"></font-awesome-icon>
            <h1 class="font-semibold">PRODUCT STOCKS</h1>
        </template>

        <main class="py-3 space-y-4">
            <!-- <div class="flex">
                <Input
                    @onInput="({ value }) => (keyword = value)"
                    :value="keyword"
                    @keyup.enter="search()"
                    @blur="search()"
                    placeholder="Search products"
                    class="rounded-l"
                    type="text"
                />

                <Button class="flex px-2 rounded-r">
                    <font-awesome-icon
                        icon="fas fa-magnifying-glass"
                        class="self-center"
                    ></font-awesome-icon>
                </Button>
            </div> -->

            <div
                class="overflow-auto border rounded"
                :style="{
                    maxHeight: `35rem`
                }"
            >
                <Link
                    class="flex justify-between border-b"
                    v-for="(product, index) in props.products"
                    :key="index"
                    :href="route(`products.edit`, product.id)"
                >
                    <div class="flex space-x-2">
                        <div class="w-20 h-20">
                            <img
                                class="block w-full h-full bg-center bg-no-repeat bg-cover"
                                :src="product.image"
                            />
                        </div>
                        <div class="space-y-1">
                            <h5 class="font-semibold">{{ product.name }}</h5>
                            <span>{{
                                String(product.barcode).toUpperCase()
                            }}</span>
                        </div>
                    </div>

                    <span
                        class="flex self-center justify-center w-6 h-6 text-sm font-semibold text-white bg-red-500 rounded-full mr-3"
                        >{{ product.stock }}
                    </span>
                </Link>
            </div>
        </main>
    </Card>
</template>

<script setup>
import Card from '../Card.vue';
import Input from '../Input.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Button from '../Button.vue';
import { defineProps, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['products']);
</script>
