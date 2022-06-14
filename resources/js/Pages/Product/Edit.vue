<template>
    <Head>
        <title>Edit Product</title>
        <meta name="Edit Product" content="Edit Product" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class="fas fa-bag-shopping" />
                <h1 class="text-lg font-semibold">EDIT PRODUCT</h1>
            </template>

            <main class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">
                <div class="space-y-1 lg:col-span-1">
                    <InputImage
                        :previewImgURL="form.image"
                        @onInput="({ file }) => (form.image = file)"
                        id="inpProdImg"
                        class="border rounded h-52"
                        @onError="
                            ({ message }) => (form.errors.image = message)
                        "
                    >
                        <div
                            class="flex items-center justify-center h-full text-xl font-semibold bg-gray-100 text-slate-700"
                        >
                            <h1>UPDATE PRODUCT IMAGE</h1>
                        </div>
                    </InputImage>
                    <Alert
                        @onClose="form.errors.image = null"
                        :message="form.errors.image"
                    />
                </div>

                <div
                    class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:col-span-3"
                >
                    <div class="space-y-1 lg:col-span-1">
                        <label for="inpBarcode">Barcode</label>
                        <Input
                            :value="form.barcode"
                            id="inpBarcode"
                            placeholder="Barcode"
                            @onInput="({ value }) => (form.barcode = value)"
                            class="rounded placeholder:text-slate-700"
                        />
                        <Alert
                            @onClose="form.errors.barcode = null"
                            :message="form.errors.barcode"
                        />
                    </div>

                    <div class="space-y-1 lg:col-span-1">
                        <label for="inpStock">Stocks</label>
                        <Input
                            :value="form.stock"
                            id="inpStock"
                            placeholder="Stocks"
                            @onInput="({ value }) => (form.stock = value)"
                            class="rounded placeholder:text-slate-700"
                        />
                        <Alert
                            @onClose="form.errors.stock = null"
                            :message="form.errors.stock"
                        />
                    </div>

                    <div class="space-y-1 lg:col-span-2">
                        <label for="inpProdName">Product Name</label>
                        <Input
                            :value="form.name"
                            id="inpProdName"
                            placeholder="Product Name"
                            @onInput="({ value }) => (form.name = value)"
                            class="rounded placeholder:text-slate-700"
                        />
                        <Alert
                            @onClose="form.errors.name = null"
                            :message="form.errors.name"
                        />
                    </div>

                    <div class="space-y-1 lg:col-span-2">
                        <label for="inpDescription">Description</label>
                        <Textarea
                            :value="form.description"
                            id="inpDescription"
                            placeholder="Description"
                            @onInput="({ value }) => (form.description = value)"
                            class="rounded placeholder:text-slate-700"
                        />
                        <Alert
                            @onClose="form.errors.description = null"
                            :message="form.errors.description"
                        />
                    </div>

                    <div
                        class="grid grid-cols-1 gap-1 lg:grid-cols-4 lg:col-span-1"
                    >
                        <label class="col-span-full" for="inpTaxPerc">
                            Tax
                        </label>
                        <div class="col-span-3">
                            <Input
                                :value="
                                    toCurrency(computeds.product.tax)
                                        .withoutSymbol
                                "
                                placeholder="Tax"
                                disabled
                                class="rounded placeholder:text-slate-700 disabled:bg-gray-100 disabled:text-gray-800"
                            />
                        </div>
                        <div class="col-span-1">
                            <div class="flex">
                                <Input
                                    type="number"
                                    :value="form.tax_percentage"
                                    id="inpTaxPerc"
                                    placeholder="Tax Percentage"
                                    @onInput="
                                        ({ value }) =>
                                            (form.tax_percentage = value)
                                    "
                                    class="border-r-0 rounded rounded-r-none placeholder:text-slate-700"
                                />
                                <span
                                    class="px-2 py-1 bg-white border border-l-0 rounded rounded-l-none"
                                    ><font-awesome-icon
                                        icon="fas fa-percent"
                                    ></font-awesome-icon
                                ></span>
                            </div>
                        </div>
                        <div class="col-span-full">
                            <Alert
                                @onClose="form.errors.tax_percentage = null"
                                :message="form.errors.tax_percentage"
                            />
                        </div>
                    </div>

                    <div
                        class="grid grid-cols-1 gap-1 lg:grid-cols-4 lg:col-span-1"
                    >
                        <label class="col-span-full" for="inpProfPerc">
                            Profit
                        </label>
                        <div class="col-span-3">
                            <Input
                                :value="
                                    toCurrency(computeds.product.profit)
                                        .withoutSymbol
                                "
                                placeholder="Profit"
                                disabled
                                class="rounded placeholder:text-slate-700 disabled:bg-gray-100 disabled:text-gray-800"
                            />
                        </div>
                        <div class="col-span-1">
                            <div class="flex">
                                <Input
                                    type="number"
                                    :value="form.profit_percentage"
                                    id="inpProfPerc"
                                    placeholder="Profit Percentage"
                                    @onInput="
                                        ({ value }) =>
                                            (form.profit_percentage = value)
                                    "
                                    class="border-r-0 rounded rounded-r-none placeholder:text-slate-700"
                                />
                                <span
                                    class="px-2 py-1 bg-white border border-l-0 rounded rounded-l-none"
                                    ><font-awesome-icon
                                        icon="fas fa-percent"
                                    ></font-awesome-icon
                                ></span>
                            </div>
                        </div>
                        <div class="col-span-full">
                            <Alert
                                @onClose="form.errors.profit_percentage = null"
                                :message="form.errors.profit_percentage"
                            />
                        </div>
                    </div>

                    <div class="space-y-1 lg:col-span-1">
                        <label for="inpGrssPrice">Gross Price</label>
                        <InputCurrency
                            id="inpGrssPrice"
                            @onBlur="({ value }) => (form.gross_price = value)"
                            @onKeyup="({ value }) => (form.gross_price = value)"
                            placeholder="Gross Price"
                            class="rounded placeholder:text-slate-700"
                            :value="toCurrency(form.gross_price).withoutSymbol"
                        />
                        <Alert
                            @onClose="form.errors.gross_price = null"
                            :message="form.errors.gross_price"
                        />
                    </div>

                    <div class="space-y-1 lg:col-span-1">
                        <label for="inpNetPrice">Net Price</label>
                        <Input
                            :value="
                                toCurrency(computeds.product.net_price)
                                    .withoutSymbol
                            "
                            id="inpNetPrice"
                            placeholder="Net Price"
                            disabled
                            class="rounded placeholder:text-slate-700 disabled:bg-gray-100 disabled:text-gray-800"
                        />
                        <Alert
                            @onClose="form.errors.net_price = null"
                            :message="form.errors.net_price"
                        />
                    </div>
                </div>
            </main>

            <div class="my-4 space-x-1">
                <Button
                    @onClick="
                        form.transform((data) => ({
                            ...data,
                            gross_price: toCurrency(data.gross_price).number
                        })).post(route(`products.update`, props.product.id), {
                            forceFormData: true
                        })
                    "
                    class="px-2 py-1 rounded"
                    >UPDATE</Button
                >
                <Button
                    @onClick="form.reset()"
                    class="px-2 py-1 text-white bg-yellow-500 rounded focus:bg-yellow-500/90 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/25"
                    >RESET</Button
                >
            </div>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from '../../Layouts/AuthLayout.vue';
import Alert from '../../Components/Alert.vue';
import Card from '../../Components/Card.vue';
import Button from '../../Components/Button.vue';
import Textarea from '../../Components/Textarea.vue';
import InputImage from '../../Components/InputImage.vue';
import InputCurrency from '../../Components/InputCurrency.vue';
import Input from '../../Components/Input.vue';
import { computed, reactive } from 'vue';
import { tap, toCurrency } from '../../Helpers';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps(['product']);

const form = useForm({
    image: props.product.image,
    barcode: props.product.barcode,
    stock: props.product.stock,
    name: props.product.name,
    description: props.product.description,
    tax_percentage: props.product.tax_percentage,
    profit_percentage: props.product.profit_percentage,
    gross_price: props.product.gross_price
});

const computeds = reactive({
    product: {
        tax: computed(
            () =>
                (toCurrency(form.gross_price).number / 100) *
                form.tax_percentage
        ),
        profit: computed(
            () =>
                (toCurrency(form.gross_price).number / 100) *
                form.profit_percentage
        ),
        net_price: computed(() => {
            const tax =
                (toCurrency(form.gross_price).number / 100) *
                form.tax_percentage;
            const profit =
                (toCurrency(form.gross_price).number / 100) *
                form.profit_percentage;
            return toCurrency(form.gross_price).number + tax + profit;
        })
    }
});
</script>
