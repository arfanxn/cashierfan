<template>

    <Head>
        <title>Add New Product</title>
        <meta name="Add New Product" content="Add New Product" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class=" fas fa-bag-shopping" />
                <h1 class="text-lg font-semibold">Add New PRODUCT</h1>
            </template>

            <main class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">

                <div class="space-y-1 lg:col-span-1">
                    <InputImage @onInput="({ file }) => (form.image = file)" id="inpProdImg" class="border rounded h-52"
                        @onError="({ message }) => (form.errors.image = message)">
                        <div
                            class="flex items-center justify-center h-full text-xl font-semibold bg-gray-100 text-slate-700">
                            <h1>ADD PRODUCT IMAGE</h1>
                        </div>
                    </InputImage>
                    <Alert :message="form.errors.image" />
                </div>


                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:col-span-3">
                    <div class="space-y-1 lg:col-span-1 ">
                        <Input :value="form.barcode" id="inpBarcode" placeholder="Barcode"
                            @onInput="({ value }) => (form.barcode = value)"
                            class="rounded placeholder:text-slate-700" />
                        <Alert :message="form.errors.barcode" />
                    </div>

                    <div class="space-y-1 lg:col-span-1 ">
                        <Input :value="form.stock" id="inpStock" placeholder="Stocks"
                            @onInput="({ value }) => (form.stock = value)" class="rounded placeholder:text-slate-700" />
                        <Alert :message="form.errors.stock" />
                    </div>

                    <div class="space-y-1 lg:col-span-2 ">
                        <Input :value="form.name" id="inpProdName" placeholder="Product Name"
                            @onInput="({ value }) => (form.name = value)" class="rounded placeholder:text-slate-700" />
                        <Alert :message="form.errors.name" />
                    </div>

                    <div class="space-y-1 lg:col-span-2 ">
                        <Textarea :value="form.description" id="inpDescription" placeholder="Description"
                            @onInput="({ value }) => (form.description = value)"
                            class="rounded placeholder:text-slate-700 " />
                        <Alert :message="form.errors.description" />
                    </div>

                    <div class="space-y-1 lg:col-span-1 ">
                        <Input :value="form.gross_price" id="inpBuyPrice" placeholder="Gross Price"
                            @onInput="({ value }) => (form.gross_price = value)"
                            class="rounded placeholder:text-slate-700 " />
                        <Alert :message="form.errors.gross_price" />
                    </div>

                    <div class="space-y-1 lg:col-span-1 ">
                        <Input :value="form.net_price" id="inpSellPrice" placeholder="Net Price"
                            @onInput="({ value }) => (form.net_price = value)"
                            class="rounded placeholder:text-slate-700 " />
                        <Alert :message="form.errors.net_price" />
                    </div>
                </div>

            </main>

            <div class="my-4 space-x-1">
                <Button @onClick="form.transform((data) => ({
                    ...data, profit: (parseFloat(data.net_price) - parseFloat(data.gross_price)).toFixed(2)
                })).post(route(`products.store`), {
                    forceFormData: true,
                })" class="px-2 py-1 rounded">UPDATE</Button>
                <Button
                    class="px-2 py-1 text-white bg-yellow-500 rounded focus:bg-yellow-500/90 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/25">CLEAR</Button>
            </div>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Alert from "../../Components/Alert.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Textarea from "../../Components/Textarea.vue";
import InputImage from "../../Components/InputImage.vue";
import Input from "../../Components/Input.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    image: ``,
    barcode: ``,
    stock: 0,
    name: ``,
    description: ``,
    gross_price: 0,
    net_price: 0,
    profit: 0,
});
</script>