<template>

    <Head>
        <title>Edit Product</title>
        <meta name="Edit Product" content="Edit Product" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class=" fas fa-bag-shopping" />
                <h1 class="text-lg font-semibold">EDIT PRODUCT</h1>
            </template>

            <main class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">

                <InputImage id="inpProdImg" class="border rounded w lg:col-span-1 h-52">
                    <div
                        class="flex items-center justify-center h-full text-xl font-semibold bg-gray-100 text-slate-700">
                        <h1>UPDATE PRODUCT IMAGE</h1>
                    </div>
                </InputImage>


                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:col-span-3">
                    <Input id="inpBarcode" placeholder="Barcode"
                        class="rounded placeholder:text-slate-700 lg:col-span-1 " />

                    <Input id="inpStock" placeholder="Stocks"
                        class="rounded placeholder:text-slate-700 lg:col-span-1 " />

                    <Input id="inpProdName" placeholder="Product Name"
                        class="rounded placeholder:text-slate-700 lg:col-span-2 " />

                    <Textarea id="inpDescription" placeholder="Description"
                        class="rounded placeholder:text-slate-700 lg:col-span-2 " />

                    <Input id="inpBuyPrice" placeholder="Buy Price"
                        class="rounded placeholder:text-slate-700 lg:col-span-1 " />

                    <Input id="inpSellPrice" placeholder="Sell Price"
                        class="rounded placeholder:text-slate-700 lg:col-span-1 " />
                </div>

            </main>

            <div class="my-4 space-x-1">
                <Button class="px-2 py-1 rounded">UPDATE</Button>
                <Button
                    class="px-2 py-1 text-white bg-yellow-500 rounded focus:bg-yellow-500/90 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/25">CLEAR</Button>
            </div>
        </Card>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Textarea from "../../Components/Textarea.vue";
import InputImage from "../../Components/InputImage.vue";
import Input from "../../Components/Input.vue";
import { randInt } from "../../Helpers";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: { Card, Button, Input, InputImage, AuthLayout, Button, Textarea, Head },

    setup() {
        return {
            Helpers: { randInt, },
        }
    }
}

</script>