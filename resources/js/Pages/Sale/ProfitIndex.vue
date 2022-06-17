<template>
    <Head>
        <title>Sale Profits</title>
        <meta name="Sale Profits" content="Sale Profits" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class="fas fa-chart-line" />
                <h1 class="text-lg font-semibold">SALE PROFITS</h1>
            </template>

            <main
                class="grid items-start grid-cols-1 gap-4 py-2 lg:grid-cols-12"
            >
                <div class="items-center space-y-1 lg:space-y-2 lg:col-span-5">
                    <label
                        for="inputReportSaleStartDate"
                        class="text-base font-semibold uppercase text-slate-700"
                        >START DATE</label
                    >
                    <Input
                        :value="form.start_date"
                        @onInput="({ value }) => (form.start_date = value)"
                        id="inputReportSaleStartDate"
                        type="date"
                        class="rounded placeholder:text-slate-700"
                    />
                    <Alert
                        @onClose="$page.props.errors.start_date = null"
                        :message="$page.props.errors.start_date"
                    ></Alert>
                </div>

                <div class="items-center space-y-1 lg:space-y-2 lg:col-span-5">
                    <label
                        for="inputReportSaleEndDate"
                        class="text-base font-semibold uppercase text-slate-700"
                        >END DATE</label
                    >
                    <Input
                        :value="form.end_date"
                        @onInput="({ value }) => (form.end_date = value)"
                        id="inputReportSaleEndDate"
                        type="date"
                        class="rounded placeholder:text-slate-700"
                    />
                    <Alert
                        @onClose="$page.props.errors.end_date = null"
                        :message="$page.props.errors.end_date"
                    ></Alert>
                </div>

                <Button
                    @click="form.get(route(`sale-profits.index`))"
                    class="flex items-center self-end justify-center py-1 space-x-1 rounded lg:col-span-2"
                >
                    <font-awesome-icon icon="fas fa-filter"></font-awesome-icon>
                    <span class="uppercase">Filter</span>
                </Button>

                <div
                    class="flex justify-end pt-4 mt-2 space-x-1 border-t-2 lg:col-span-12 lg:space-x-3 lg:mt-4"
                >
                    <JSONExcel
                        :header="title"
                        :name="title"
                        :data="
                            props.products.map((product) => ({
                                ...product,
                                pivot: JSON.stringify(product.pivot)
                            }))
                        "
                        class="flex items-center justify-center px-2 py-1 space-x-1 bg-green-700 rounded lg:px-4 lg:col-span-2 text-white pointer hover:bg-green-700/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-green-700/25 focus:bg-green-700/90"
                    >
                        <font-awesome-icon
                            icon="fas fa-file-excel"
                        ></font-awesome-icon>
                        <span class="uppercase">EXCEL</span>
                    </JSONExcel>
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
                                            'justify-center':
                                                !products.showDescription,
                                            'w-64 lg:w-96':
                                                products.showDescription
                                        }"
                                    >
                                        <input
                                            @change="
                                                products.showDescription =
                                                    !products.showDescription
                                            "
                                            type="checkbox"
                                            id="radioShowProdDesc"
                                            class="default:ring-4"
                                        />
                                        <label
                                            v-show="products.showDescription"
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
                                v-for="(product, index) in props.products
                                    .data || props.products"
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
                                        v-show="products.showDescription"
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

                <div class="flex flex-row-reverse w-full mt-4 lg:col-span-12">
                    <ButtonPagination
                        class="basis-full lg:basis-3/12"
                        :currentPage="products.currentPage"
                    />
                </div>
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from '../../Layouts/AuthLayout.vue';
import JsBarcode from 'jsbarcode';
import Alert from '../../Components/Alert.vue';
import JSONExcel from 'vue-json-excel3';
import Card from '../../Components/Card.vue';
import Button from '../../Components/Button.vue';
import ButtonLink from '../../Components/ButtonLink.vue';
import ButtonPagination from '../../Components/ButtonPagination.vue';
import Input from '../../Components/Input.vue';
import { toCurrency, tap, isset } from '../../Helpers';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { computed, defineProps, reactive, onMounted } from 'vue';

const props = defineProps(['products']);

const url = computed(() => new URL(window.location.href));

const form = useForm({
    start_date: url.value.searchParams.get(`start_date`),
    end_date: url.value.searchParams.get(`end_date`)
});

const products = reactive({
    currentPage: parseInt(url.value.searchParams.get(`page`) || 1),
    showDescription: false
});

onMounted(() => {
    JsBarcode('.barcode').init();
});

const title = computed(() => {
    const saleProfit = props.products;
    return isset(
        () =>
            `sale-profits-report-between-${String(
                saleProfit[0]['created_at']
            ).replace(/T.*/gi, '')}-and-${String(
                saleProfit[saleProfit.length - 1]['created_at']
            ).replace(/T.*/gi, '')}` + '.xls'
    );
});
</script>
