<template>
    <main class="space-y-3">
        <section class="space-y-1">
            <div class="flex">
                <Input
                    @onInput="({ value }) => (keyword = value)"
                    placeholder="Search added products by Barcode or Name"
                    class="rounded-l placeholder:italic"
                ></Input>
                <Button class="flex px-2 rounded-r">
                    <font-awesome-icon
                        icon="fas fa-magnifying-glass"
                        class="self-center"
                    >
                    </font-awesome-icon>
                </Button>
            </div>
        </section>
        <section>
            <div class="relative overflow-x-auto shadow lg:col-span-2">
                <table
                    class="w-full text-sm text-left text-black border border-collapse border-gray-500"
                >
                    <thead class="text-xs text-white uppercase bg-indigo-900">
                        <tr>
                            <th
                                scope="col"
                                class="px-4 py-3 border border-gray-500"
                            >
                                #
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 border border-gray-500"
                            >
                                Product
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 border border-gray-500"
                            >
                                Price
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 border border-gray-500"
                            >
                                Qty
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 border border-gray-500"
                            >
                                Sub Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(product, index) in SaleStore.products
                                .datasets"
                            v-show="
                                keywordRegex.test(product.barcode) ||
                                keywordRegex.test(product.name)
                            "
                            :key="index"
                            class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300"
                        >
                            <td
                                class="py-4 px-2 space-x-1 border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap"
                            >
                                <Button
                                    @click.prevent="remove(product)"
                                    class="px-2 py-1 space-x-1 text-white bg-red-600 rounded hover:bg-red-600/90 focus:ring-red-600/25 focus:bg-red-600/90"
                                >
                                    <font-awesome-icon
                                        icon="fas fa-trash-can"
                                    ></font-awesome-icon>
                                </Button>
                            </td>
                            <td
                                class="p-0 font-medium text-gray-900 border border-slate-500"
                            >
                                <div class="flex p-0 space-x-2">
                                    <img
                                        class="w-16 min-h-full p-0 m-0 bg-center bg-no-repeat bg-cover aspect-square"
                                        :src="product.image"
                                    />
                                    <div class="flex flex-col py-1 space-y-1">
                                        <h5>{{ product.name }}</h5>
                                        <small class="uppercase">{{
                                            product.barcode.toUpperCase()
                                        }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 border border-slate-500">
                                <span>{{
                                    toCurrency(product.net_price).output
                                }}</span>
                            </td>
                            <td class="px-4 py-4 border border-slate-500">
                                <Input
                                    type="number"
                                    :min="1"
                                    :max="product.stock"
                                    @input="
                                        (event) =>
                                            updateQuantity(event, product)
                                    "
                                    class="bg-transparent border-0 outline-none focus:outline-none"
                                    :value="product.quantity"
                                />
                            </td>
                            <td class="px-4 py-4 border border-slate-500">
                                <span>
                                    {{
                                        toCurrency(
                                            parseFloat(product.net_price) *
                                                (product.quantity ||
                                                    product.qty)
                                        ).output
                                    }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td class="px-4 py-4 uppercase whitespace-nowrap">
                                TOTAL
                            </td>
                            <td
                                class="px-4 py-4 border border-slate-500 whitespace-nowrap"
                            >
                                {{
                                    toCurrency(
                                        parseFloat(SaleStore.sum_gross_price) +
                                            parseFloat(SaleStore.sum_profit)
                                    ).output
                                }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </main>
</template>

<script setup>
import Alert from '../../Alert.vue';
import Button from '../../Button.vue';
import Input from '../../Input.vue';
import { computed, ref } from 'vue';
import { toCurrency, tap } from '../../../Helpers';
import { useSale } from '../../../Stores/Sale.js';

const SaleStore = useSale();

const keyword = ref('');
const keywordRegex = computed(() => new RegExp(keyword.value, 'i'));

function updateQuantity(event, product) {
    const qty = parseInt(event.target.value);

    if (qty == 0 || !qty.toString().length || qty > product.stock) {
        event.target.value = SaleStore.products.getById(product.id)['quantity'];
        return;
    }

    // update the quantity
    SaleStore.products.updateQuantity(product.id, qty);
    event.target.value = qty;
}

function remove(product) {
    SaleStore.removeProduct(product.id);
}
</script>
