<template>
    <Head>
        <title>Input Trx</title>
        <meta name="Input Trx" content="Page of Create Transaction" />
    </Head>

    <AuthLayout>
        <main class="grid items-start grid-cols-1 gap-4 lg:grid-cols-12">
            <InsertProduct class="lg:col-span-4" />

            <section
                class="grid grid-flow-row grid-cols-1 gap-4 auto-rows-max lg:col-span-8"
            >
                <GrandTotal />

                <section
                    class="grid grid-cols-1 gap-4 p-4 bg-white rounded lg:grid-cols-2"
                >
                    <div class="space-y-1">
                        <label class="text-gray-700">Cashier</label>
                        <Input
                            disabled
                            :value="
                                tap(() => {
                                    const cashier = $page.props?.auth?.user;
                                    SaleStore.$patch({ cashier });
                                    return SaleStore.$state.cashier.name;
                                })
                            "
                            class="rounded disabled:bg-gray-100 disabled:text-gray-800"
                        />
                    </div>

                    <InsertCustomer />

                    <ProductTable class="lg:col-span-2" />

                    <hr class="border-y-2 lg:col-span-2" />

                    <InsertPayment class="lg:col-span-2" />
                </section>
            </section>
        </main>
    </AuthLayout>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import AuthLayout from '../../Layouts/AuthLayout.vue';
import InsertProduct from '../../Components/Sale/Create/InsertProduct.vue';
import GrandTotal from '../../Components/Sale/Create/GrandTotal.vue';
import InsertCustomer from '../../Components/Sale/Create/InsertCustomer.vue';
import ProductTable from '../../Components/Sale/Create/ProductTable.vue';
import InsertPayment from '../../Components/Sale/Create/InsertPayment.vue';
import Input from '../../Components/Input.vue';
import { tap } from '../../Helpers.js';
import { useSale } from '../../Stores/Sale';

const SaleStore = useSale();
</script>
