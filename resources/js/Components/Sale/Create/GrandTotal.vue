<template>
    <Card>
        <main class="flex flex-col justify-between space-y-2 bg-white text-slate-700 ">
            <section class="flex justify-between">
                <section class="">
                    <h2 class="font-semibold lg:text-2xl">GRAND TOTAL</h2>
                </section>

                <section class="flex flex-col flex-wrap items-end justify-end space-x-2 text-sm md:flex-row md:text-lg">
                    <div class="flex flex-wrap space-x-2">
                        <div class="space-x-1">
                            <small>PRICE</small>
                            <small class="font-semibold">{{ toCurrency(
                                    parseFloat(SaleStore.sum_gross_price) + parseFloat(SaleStore.sum_profit)
                                ).withoutSymbol
                            }}
                            </small>
                        </div>
                        <div class="self-end">
                            <small class="font-semibold">+</small>
                        </div>
                        <div class="space-x-1">
                            <small>TAX</small>
                            <small class="font-semibold ">{{ toCurrency(SaleStore.sum_tax).withoutSymbol }}</small>
                        </div>
                    </div>

                    <div v-show="parseFloat(SaleStore.discount) > 0" class="flex flex-wrap space-x-2">
                        <div class="self-end">
                            <small class="font-semibold">-</small>
                        </div>
                        <div class="space-x-1">
                            <small>DISCOUNT</small>
                            <small class="font-semibold">{{ toCurrency(SaleStore.discount).withoutSymbol }}
                            </small>
                        </div>
                    </div>

                    <div class="flex flex-wrap space-x-2">
                        <small class="self-end font-semibold">=</small>
                        <h2 class="font-semibold lg:text-2xl">{{ toCurrency(SaleStore.sum_net_price).output }}</h2>
                    </div>
                </section>
            </section>

            <section v-show="parseFloat(SaleStore.customer_pay_money) > 0"
                class="flex flex-col items-end justify-end pt-1 space-x-2 text-sm border-t-2 flex-min md:text-lg border-slate-500 ">
                <section class="flex flex-col flex-wrap items-end justify-end space-x-2 md:flex-row ">
                    <div class="flex flex-wrap space-x-2">
                        <div class="space-x-1">
                            <small>PAY</small>
                            <small class="font-semibold ">{{
                                    toCurrency(SaleStore.customer_pay_money).withoutSymbol
                            }}</small>
                        </div>
                        <div class="self-end">
                            <small class="font-semibold">-</small>
                        </div>
                        <div class="space-x-1">
                            <small>SUM</small>
                            <small class="font-semibold">{{ toCurrency(SaleStore.sum_net_price).withoutSymbol }}
                            </small>
                        </div>
                    </div>

                    <div class="flex flex-wrap space-x-2">
                        <div class="self-end">
                            <small class="font-semibold">=</small>
                        </div>
                        <div class="space-x-1 font-semibold text-green-600">
                            <span>CHANGE</span>
                            <span>{{ toCurrency(SaleStore.customer_change_money).output
                            }}</span>
                        </div>
                    </div>
                </section>
            </section>

        </main>
    </Card>
</template>

<script setup>
import Card from "../../Card.vue";
import Button from "../../Button.vue";
import Input from "../../Input.vue";
import { useSale } from "../../../Stores/Sale.js";
import { toCurrency } from "../../../Helpers";

const SaleStore = useSale();




</script>