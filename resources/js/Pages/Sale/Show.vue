<template>
    <Head>
        <title>Sale Details</title>
        <meta name="sale" content="sale details" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class="fas fa-info-circle" />
                <h1 class="text-lg font-semibold">SALE DETAILS</h1>
            </template>

            <main class="py-2 space-y-1 md:space-y-2 lg:space-y-3">
                <div
                    class="flex justify-end space-x-1 lg:col-span-12 lg:space-x-3"
                >
                    <Button
                        class="flex items-center justify-center px-2 py-1 space-x-1 bg-green-700 rounded lg:px-4 lg:col-span-2 hover:bg-green-700/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-green-700/25 focus:bg-green-700/90"
                    >
                        <font-awesome-icon
                            icon="fas fa-file-excel"
                        ></font-awesome-icon>
                        <span class="uppercase">EXCEL</span>
                    </Button>
                    <Button
                        class="flex items-center justify-center px-2 py-1 space-x-1 bg-red-700 rounded lg:px-4 lg:col-span-2 hover:bg-red-700/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-700/25 focus:bg-red-700/90"
                    >
                        <font-awesome-icon
                            icon="fas fa-file-pdf"
                        ></font-awesome-icon>
                        <span class="uppercase">PDF</span>
                    </Button>
                </div>

                <div
                    class="relative mt-4 overflow-x-auto shadow lg:col-span-12"
                >
                    <table
                        class="w-full text-sm text-left text-black border border-collapse border-gray-500"
                    >
                        <thead
                            class="text-xs text-white uppercase bg-indigo-900"
                        >
                            <tr>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Datetime
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Invoice
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Cashier
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Customer
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Sum Tax
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Sum Profit
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Sum Gross Price
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Sum Net Price
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Cash
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Change
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300"
                            >
                                <td
                                    class="px-4 py-4 text-gray-900 align-top border border-slate-500 whitespace-nowrap"
                                >
                                    <span class="font-semibold">
                                        {{
                                            tap(
                                                new Date(props.sale.created_at),
                                                (crdat) =>
                                                    `${crdat.getDate()}-${crdat.getMonth()}-${crdat.getFullYear()}
                                    ${crdat.getHours()}:${crdat.getMinutes()}:${crdat.getSeconds()}`
                                            )
                                        }}</span
                                    >
                                </td>
                                <td
                                    class="px-4 py-4 font-medium text-gray-900 align-top border border-slate-500"
                                >
                                    <span class="font-semibold">
                                        {{
                                            String(
                                                props.sale.invoice
                                            ).toUpperCase()
                                        }}</span
                                    >
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500 whitespace-nowrap"
                                >
                                    <div class="flex flex-col">
                                        <span class="font-semibold">{{
                                            props.sale.cashier?.name
                                        }}</span>
                                        <span>{{
                                            props.sale.cashier?.details
                                                ?.phone_number
                                        }}</span>
                                        <span>{{
                                            props.sale.cashier?.email
                                        }}</span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500 whitespace-nowrap"
                                >
                                    <div class="flex flex-col">
                                        <span class="font-semibold">{{
                                            props.sale.customer?.name
                                        }}</span>
                                        <span>{{
                                            props.sale.customer?.phone_number
                                        }}</span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <div class="flex space-x-1">
                                        <span>{{
                                            toCurrency(props.sale.sum_tax)
                                                .output
                                        }}</span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <div class="flex space-x-1">
                                        <span>{{
                                            toCurrency(props.sale.sum_profit)
                                                .output
                                        }}</span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{
                                        toCurrency(props.sale.sum_gross_price)
                                            .output
                                    }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{
                                        toCurrency(props.sale.sum_net_price)
                                            .output
                                    }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{
                                        toCurrency(
                                            props.sale.customer_pay_money
                                        ).output
                                    }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{
                                        toCurrency(
                                            props.sale.customer_change_money
                                        ).output
                                    }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="relative mt-4 overflow-x-auto shadow">
                    <table
                        class="text-sm text-left text-black border border-collapse border-gray-500"
                    >
                        <thead
                            class="text-xs text-white uppercase bg-indigo-900"
                        >
                            <tr>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Product
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500 w-min"
                                >
                                    <div
                                        class="flex items-center space-x-1"
                                        :class="{
                                            'justify-center': !showDescription,
                                            'w-64 lg:w-96': showDescription
                                        }"
                                    >
                                        <input
                                            @change="
                                                showDescription =
                                                    !showDescription
                                            "
                                            type="checkbox"
                                            id="radioShowProdDesc"
                                            class="default:ring-4"
                                        />
                                        <label
                                            v-show="showDescription"
                                            for="radioShowProdDesc"
                                            >Description</label
                                        >
                                    </div>
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Tax
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Profit
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Gross Price
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Net Price
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Quantity
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Tax x Quantity
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Profit x Quantity
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Gross Price x Quantity
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Net Price x Quantity
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(product, index) in props.sale.products"
                                :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300"
                            >
                                <td
                                    class="font-semibold text-gray-900 align-top border border-slate-500 whitespace-nowrap"
                                >
                                    <div class="flex space-x-2">
                                        <div class="w-28 h-28 md:h-36 md:w-36">
                                            <img
                                                class="block w-full h-full bg-center bg-no-repeat bg-cover"
                                                :src="product.image"
                                                alt=""
                                            />
                                        </div>
                                        <div class="space-y-1">
                                            <span class="text-lg">{{
                                                product.name
                                            }}</span>
                                            <svg
                                                class="p-0 m-0 barcode"
                                                jsbarcode-format="CODE39"
                                                jsbarcode-width="1"
                                                jsbarcode-height="30"
                                                jsbarcode-margin="5"
                                                :jsbarcode-value="
                                                    product.barcode.toUpperCase() ||
                                                    product.id
                                                "
                                                jsbarcode-textmargin="0"
                                                jsbarcode-fontoptions="bold"
                                            ></svg>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 font-medium text-gray-900 align-top border border-slate-500"
                                >
                                    <p
                                        v-show="showDescription"
                                        class="break-words"
                                    >
                                        {{
                                            product.description ||
                                            'No Description'
                                        }}
                                    </p>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <div class="flex space-x-1">
                                        <small class="font-bold"
                                            >{{ product.tax_percentage }}%
                                        </small>
                                        <span>{{
                                            toCurrency(product.tax).output
                                        }}</span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <div class="flex space-x-1">
                                        <small class="font-bold"
                                            >{{ product.profit_percentage }}%
                                        </small>
                                        <span>{{
                                            toCurrency(product.profit).output
                                        }}</span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{
                                        toCurrency(product.gross_price).output
                                    }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{
                                        toCurrency(product.net_price).output
                                    }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{ product.quantity }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <div class="flex space-x-1">
                                        <span>{{
                                            toCurrency(product.sum_tax).output
                                        }}</span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <div class="flex space-x-1">
                                        <span>{{
                                            toCurrency(product.sum_profit)
                                                .output
                                        }}</span>
                                    </div>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{
                                        toCurrency(product.sum_gross_price)
                                            .output
                                    }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 align-top border border-slate-500"
                                >
                                    <span>{{
                                        toCurrency(product.sum_net_price).output
                                    }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from '../../Layouts/AuthLayout.vue';
import JsBarcode from 'jsbarcode';
import { Link, Head } from '@inertiajs/inertia-vue3';
import { toCurrency, tap } from '../../Helpers.js';
import { ref, defineProps, onMounted } from 'vue';
import Alert from '../../Components/Alert.vue';
import Card from '../../Components/Card.vue';
import Button from '../../Components/Button.vue';
import ButtonPagination from '../../Components/ButtonPagination.vue';
import ButtonLink from '../../Components/ButtonLink.vue';
import Input from '../../Components/Input.vue';

const props = defineProps(['sale']);

const showDescription = ref(false);

onMounted(() => {
    JsBarcode('.barcode').init();
});
</script>
