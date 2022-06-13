<template>
    <div
        class="bg-white text-black w-96 h-auto text-xs absolute top-5 left-5 p-8"
    >
        <header class="text-center px-2">
            <h1 class="font-bold text-sm">Cashierfan</h1>
            <p>
                Address : Lorem ipsum dolor sit amet, consectetur adipisicing
                elit.
            </p>
            <p>Phone Number : 0895-0608-9254</p>
        </header>

        <main class="my-6 space-y-2">
            <hr class="border border-dashed border-black" />

            <section>
                <ul class="flex justify-between">
                    <li class="text-xs basis-5/12">DATETIME</li>
                    <li class="text-xs basis-1/12">:</li>
                    <li class="text-xs basis-full">
                        {{
                            tap(
                                new Date($page.props.sale.created_at),
                                (crdat) =>
                                    `${crdat.getDate()}-${crdat.getMonth()}-${crdat.getFullYear()}
                                    ${crdat.getHours()}:${crdat.getMinutes()}:${crdat.getSeconds()}`
                            )
                        }}
                    </li>
                </ul>
                <ul class="flex justify-between">
                    <li class="text-xs basis-5/12">INVOICE</li>
                    <li class="text-xs basis-1/12">:</li>
                    <li class="text-xs basis-full uppercase">
                        {{ $page.props.sale.invoice }}
                    </li>
                </ul>
                <ul class="flex justify-between">
                    <li class="text-xs basis-5/12">CASHIER</li>
                    <li class="text-xs basis-1/12">:</li>
                    <li class="text-xs basis-full">
                        {{ $page.props.sale.cashier.name }}
                    </li>
                </ul>
                <ul class="flex justify-between">
                    <li class="text-xs basis-5/12">CUSTOMER</li>
                    <li class="text-xs basis-1/12">:</li>
                    <li class="text-xs basis-full">
                        {{ $page.props.sale.customer.name }}
                    </li>
                </ul>
            </section>

            <hr class="border border-dashed border-black" />

            <section>
                <table class="w-full">
                    <tr class="border-b-2 border-dashed border-black">
                        <th class="text-xs font-normal pb-2 text-left">
                            PRODUCT
                        </th>
                        <th class="text-xs font-normal pb-2 text-right">QTY</th>
                        <th class="text-xs font-normal pb-2 text-right">
                            PRICE
                        </th>
                    </tr>
                    <tr
                        v-for="(product, index) in $page.props.sale.products"
                        :key="index"
                        class="align-top"
                    >
                        <td class="py-1 text-xs text-left">
                            {{ product.name }}
                        </td>
                        <td class="py-1 text-xs text-right">
                            {{ product.pivot.quantity }}
                        </td>
                        <td class="py-1 text-xs text-right">
                            {{ toCurrency(product.net_price).output }}
                        </td>
                    </tr>
                </table>
            </section>

            <hr class="border border-dashed border-black" />

            <section class="flex-col flex items-end">
                <ul class="flex justify-between space-x-2 text-xs">
                    <li>PRICE</li>
                    <li>:</li>
                    <li class="basis-full">
                        {{
                            tap(
                                parseFloat($page.props.sale.sum_gross_price) +
                                    parseFloat($page.props.sale.sum_profit),
                                (price) => toCurrency(price).output
                            )
                        }}
                    </li>
                </ul>
                <ul class="flex justify-between space-x-2 text-xs">
                    <li>TAX</li>
                    <li>:</li>
                    <li class="basis-full">
                        + {{ toCurrency($page.props.sale.sum_tax).output }}
                    </li>
                </ul>
                <ul
                    v-show="parseFloat($page.props.sale.discount) > 0"
                    class="flex justify-between space-x-2 text-xs"
                >
                    <li>DISCOUNT</li>
                    <li>:</li>
                    <li class="basis-full">
                        - {{ toCurrency($page.props.sale.discount).output }}
                    </li>
                </ul>
                <ul class="flex justify-between space-x-2 text-xs">
                    <li>SUMMARY</li>
                    <li>:</li>
                    <li class="basis-full">
                        {{ toCurrency($page.props.sale.sum_net_price).output }}
                    </li>
                </ul>
            </section>

            <hr class="border border-dashed border-black" />

            <section class="flex-col flex items-end">
                <ul class="flex justify-between space-x-2 text-xs">
                    <li>CASH</li>
                    <li>:</li>
                    <li class="basis-full">
                        {{
                            toCurrency(
                                $page.props.sale.customer_pay_money ||
                                    $page.props.sale.cash
                            ).output
                        }}
                    </li>
                </ul>
                <ul class="flex justify-between space-x-2 text-xs">
                    <li>CHANGE</li>
                    <li>:</li>
                    <li class="basis-full">
                        {{
                            toCurrency(
                                $page.props.sale.customer_change_money ||
                                    $page.props.sale.change
                            ).output
                        }}
                    </li>
                </ul>
            </section>
        </main>

        <div class="my-5 space-y-0.5">
            <hr class="border border-dashed border-black" />
            <hr class="border border-dashed border-black" />
        </div>

        <footer class="text-center uppercase px-2">
            <p class="font-semibold text-xs">
                Thanks for shopping at our store.
            </p>
        </footer>
    </div>
</template>

<script setup>
import { toCurrency, tap } from '../../Helpers';
import { onMounted } from 'vue';

onMounted(() => {
    // window.print();
});
</script>
