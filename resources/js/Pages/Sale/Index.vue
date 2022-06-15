<template>
    <Head>
        <title>Sales</title>
        <meta name="Sales" content="Sales" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class="fas fa-chart-simple" />
                <h1 class="text-lg font-semibold">Sales</h1>
            </template>

            <main
                class="grid items-start grid-cols-1 gap-4 py-2 lg:grid-cols-12"
            >
                <div class="items-center space-y-1 lg:space-y-2 lg:col-span-6">
                    <label
                        for="inputSaleSearch"
                        class="text-base font-semibold uppercase text-slate-700"
                        >SEARCH SALES</label
                    >
                    <Input
                        :value="form.keyword"
                        @onInput="({ value }) => (form.keyword = value)"
                        @keyup.enter="filter()"
                        @blur="filter()"
                        id="inputSaleSearch"
                        class="rounded placeholder:text-slate-700"
                        placeholder="Invoice (1A2Bxxxx) or Cashier/Customer Name"
                    />
                    <Alert
                        @onClose="$page.props.errors.keyword = null"
                        :message="$page.props.errors.keyword"
                    />
                </div>

                <div class="items-center space-y-1 lg:space-y-2 lg:col-span-2">
                    <label
                        for="inputSaleStartDate"
                        class="text-base font-semibold uppercase text-slate-700"
                        >START DATE</label
                    >
                    <Input
                        :value="form.start_date"
                        @onInput="({ value }) => (form.start_date = value)"
                        id="inputSaleStartDate"
                        type="date"
                        class="rounded placeholder:text-slate-700"
                    />
                    <Alert
                        @onClose="$page.props.errors.start_date = null"
                        :message="$page.props.errors.start_date"
                    ></Alert>
                </div>

                <div class="items-center space-y-1 lg:space-y-2 lg:col-span-2">
                    <label
                        for="inputSaleEndDate"
                        class="text-base font-semibold uppercase text-slate-700"
                        >END DATE</label
                    >
                    <Input
                        :value="form.end_date"
                        @onInput="({ value }) => (form.end_date = value)"
                        id="inputSaleEndDate"
                        type="date"
                        class="rounded placeholder:text-slate-700"
                    />
                    <Alert
                        @onClose="$page.props.errors.end_date = null"
                        :message="$page.props.errors.end_date"
                    ></Alert>
                </div>

                <div
                    class="flex items-center self-end justify-center space-x-1 lg:space-x-2 lg:col-span-2"
                >
                    <Button
                        class="flex items-center justify-center w-full py-1 text-black bg-yellow-500 rounded hover:bg-yellow-500/90 hover:text-black focus:outline-none focus:ring-4 focus:ring-yellow-500/25 focus:bg-yellow-500/90"
                    >
                        <span class="uppercase">Clear</span>
                    </Button>
                    <Button
                        @click="filter()"
                        class="flex items-center justify-center w-full py-1 space-x-1 rounded"
                    >
                        <font-awesome-icon
                            icon="fas fa-filter"
                        ></font-awesome-icon>
                        <span class="uppercase">Filter</span>
                    </Button>
                </div>

                <div
                    class="flex justify-end pt-4 mt-2 space-x-1 border-t-2 lg:col-span-12 lg:space-x-3 lg:mt-4"
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
                                    Summary
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(sale, index) in props.sales.data"
                                :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300"
                            >
                                <td
                                    class="px-4 py-4 text-gray-900 border border-slate-500 whitespace-nowrap"
                                >
                                    <span class="font-semibold">{{
                                        tap(
                                            new Date(sale.created_at),
                                            (crdat) =>
                                                `${crdat.getDate()}-${crdat.getMonth()}-${crdat.getFullYear()}
                                    ${crdat.getHours()}:${crdat.getMinutes()}:${crdat.getSeconds()}`
                                        )
                                    }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 font-medium text-gray-900 border border-slate-500"
                                >
                                    <span class="font-semibold">
                                        {{
                                            String(sale.invoice).toUpperCase()
                                        }}</span
                                    >
                                </td>
                                <td
                                    class="px-4 py-4 border border-slate-500 whitespace-nowrap"
                                >
                                    {{ sale.cashier.name }}
                                </td>
                                <td
                                    class="px-4 py-4 border border-slate-500 whitespace-nowrap"
                                >
                                    {{ sale.customer.name }}
                                </td>
                                <td
                                    class="px-4 py-4 border border-slate-500 whitespace-nowrap"
                                >
                                    {{ toCurrency(sale.sum_net_price).output }}
                                </td>
                                <td
                                    class="py-4 px-2 space-x-1 border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap"
                                >
                                    <ButtonLink
                                        :href="route(`sales.show`, 1)"
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 rounded"
                                    >
                                        <font-awesome-icon
                                            icon="fas fa-circle-info"
                                        ></font-awesome-icon>
                                        <span class="hidden lg:inline-block"
                                            >DETAILS</span
                                        >
                                    </ButtonLink>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-row-reverse w-full mt-4 lg:col-span-12">
                    <ButtonPagination
                        class="basis-full lg:basis-3/12"
                        :currentPage="props.sales.current_page"
                    />
                </div>
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from '../../Layouts/AuthLayout.vue';
import Alert from '../../Components/Alert.vue';
import Card from '../../Components/Card.vue';
import Button from '../../Components/Button.vue';
import ButtonLink from '../../Components/ButtonLink.vue';
import ButtonPagination from '../../Components/ButtonPagination.vue';
import Textarea from '../../Components/Textarea.vue';
import Input from '../../Components/Input.vue';
import { randInt, tap, toCurrency } from '../../Helpers';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineProps, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['sales']);

const url = computed(() => new URL(window.location.href));

const form = useForm({
    keyword: url.value.searchParams.get(`keyword`),
    start_date: url.value.searchParams.get(`start_date`),
    end_date: url.value.searchParams.get(`end_date`)
});

function filter() {
    form.get(route('sales.index'));
}
</script>
