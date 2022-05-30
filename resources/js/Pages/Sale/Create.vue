<template>

    <Head>
        <title>Input Trx</title>
        <meta name="Input Trx" content="Page of Create Transaction" />
    </Head>

    <AuthLayout>
        <main class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">
            <section class="p-4 bg-white rounded lg:col-span-1">
                <div class="flex items-center bg-indigo-900 rounded">
                    <font-awesome-icon icon="fas fa-barcode" class="px-2 py-1 text-white" />
                    <Input placeholder="Scan or Input Barcode" class="rounded-r" />
                </div>
                <div class="mt-3 space-y-1">
                    <label class="text-gray-700">Product Name</label>
                    <Input disabled placeholder="Product Name"
                        class="rounded disabled:bg-gray-200 disabled:text-white " />
                </div>
                <div class="mt-3 space-y-1">
                    <label class="text-gray-700" for="inpQty">Quantity</label>
                    <Input id="inpQty" placeholder="1" type="number" class="rounded" />
                </div>

                <div class="flex justify-end mt-6 space-x-1">
                    <Button
                        class="px-2 py-1 text-black bg-yellow-500 rounded hover:bg-yellow-500/90 hover:text-black focus:ring-yellow-500/25 focus:bg-yellow-500/90">CLEAR</Button>
                    <Button class="px-2 py-1 rounded ">ADD
                        ITEM</Button>
                </div>
            </section>

            <div class="grid grid-flow-row grid-cols-1 gap-4 auto-rows-max lg:col-span-3">
                <section
                    class="overflow-hidden bg-indigo-900 border shadow rounded-xl before:pt-2 before:rounded-t before:block before:bg-indigo-900 ">
                    <main
                        class="flex justify-between h-full px-4 py-2 font-semibold bg-white rounded-t-lg lg:text-2xl text-slate-700 rounded-b-xl">
                        <h1>GRAND
                            TOTAL</h1>
                        <h1>Rp. {{ randInt(10000, 1000000) }}</h1>
                    </main>
                </section>

                <section class="grid grid-cols-1 gap-4 p-4 bg-white rounded lg:grid-cols-2">
                    <div class="space-y-1">
                        <label class="text-gray-700">Cashier</label>
                        <Input disabled value="Admin" class="rounded disabled:bg-gray-200 disabled:text-gray-800 " />
                    </div>
                    <div class="relative space-y-1">
                        <label class="text-gray-700">Customer</label>
                        <!-- <div class="flex"> -->
                        <Input placeholder="Enter registered Customer or create on Customer Menu"
                            @focus="showCustomerOptions = true" @blur="showCustomerOptions = false"
                            class="rounded disabled:bg-gray-200 disabled:text-white " list="customers" />
                        <!--  -->
                        <div v-show="showCustomerOptions"
                            class="absolute left-0 right-0 z-10 w-full overflow-hidden transition duration-500 ease-in-out bg-white border rounded border-slate-500 top-1653668428146 ">
                            <ul class="block overflow-y-scroll max-h-52">
                                <li class="px-2 py-1 text-black bg-white border hover:bg-indigo-900/75 hover:text-white"
                                    v-for="(item, index) in [1, 2, 3, 4, 5, 6, 7]" :key="index"
                                    :value="`Person ` + item">
                                    Person {{ item }}</li>
                            </ul>
                        </div>

                        <!-- </div> -->
                    </div>

                    <div class="flex lg:col-span-2">
                        <Input placeholder="Search added items by name" class="rounded-l placeholder:italic "></Input>
                        <Button @onClick="searchAddedItems" class="flex px-2 rounded-r">
                            <font-awesome-icon icon="fas fa-magnifying-glass" class="self-center">
                            </font-awesome-icon>
                        </Button>
                    </div>

                    <div class="relative overflow-x-auto shadow lg:col-span-2">
                        <table class="w-full text-sm text-left text-black border border-collapse border-gray-500 ">
                            <thead class="text-xs text-white uppercase bg-indigo-900">
                                <tr>
                                    <th scope="col" class="px-4 py-3 border border-gray-500">
                                        #
                                    </th>
                                    <th scope="col" class="px-4 py-3 border border-gray-500">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-4 py-3 border border-gray-500">
                                        Price
                                    </th>
                                    <th scope="col" class="px-4 py-3 border border-gray-500">
                                        Qty
                                    </th>
                                    <th scope="col" class="px-4 py-3 border border-gray-500">
                                        Sub Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in [1, 2, 3, 4, 5, 6, 7]" :key="index"
                                    class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300">
                                    <td
                                        class="py-4 px-2 space-x-1  border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap">

                                        <Button
                                            class="px-2 py-1 space-x-1 text-white bg-red-600 rounded hover:bg-red-600/90 focus:ring-red-600/25 focus:bg-red-600/90">
                                            <font-awesome-icon icon="fas fa-trash-can"></font-awesome-icon>

                                        </Button>
                                    </td>
                                    <td class="px-4 py-4 font-medium text-gray-900 border border-slate-500">
                                        Apple MacBook Pro 17"
                                    </td>
                                    <td class="px-4 py-4 border border-slate-500">
                                        Rp. {{ randInt(1000000, 9999999) }}
                                    </td>
                                    <td class="px-4 py-4 border border-slate-500">
                                        {{ randInt(1, 10) }}
                                    </td>
                                    <td class="px-4 py-4 border border-slate-500">
                                        Rp. {{ randInt(1000000, 9999999) }}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="px-4 py-4 uppercase whitespace-nowrap ">TOTAL</td>
                                    <td class="px-4 py-4 border border-slate-500 whitespace-nowrap">Rp. {{
                                            randInt(10000000, 99999999)
                                    }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <hr class="border-2 lg:col-span-2">

                    <div class="flex flex-col items-end gap-4 lg:col-span-2">
                        <div class="w-3/4 space-y-1 lg:w-2/4">
                            <label class="text-gray-700">Discount (Rp.)</label>
                            <Input class="rounded" value="0" />
                        </div>

                        <div class="w-3/4 space-y-1 lg:w-2/4">
                            <label class="text-gray-700">Pay (Rp.)</label>
                            <Input placeholder="Amount" class="rounded " />
                        </div>

                        <div class="flex space-x-2">
                            <Button
                                class="px-2 py-1 text-black bg-yellow-500 rounded hover:bg-yellow-500/90 hover:text-black focus:ring-yellow-500/25 focus:bg-yellow-500/90">CLEAR</Button>
                            <Button class="px-2 py-1 rounded "><span class="whitespace-nowrap ">PAY ORDER &
                                    PRINT</span></Button>
                        </div>
                    </div>

                </section>
            </div>

        </main>
    </AuthLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Input from "../../Components/Input.vue";
import { randInt } from "../../Helpers";
import { ref } from "vue";

const showCustomerOptions = ref(false);

function searchAddedItems() {
}




</script>