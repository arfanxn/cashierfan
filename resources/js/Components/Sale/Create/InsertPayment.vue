<template>
    <main class="flex flex-col items-end gap-4">
        <div class="w-3/4 space-y-1 lg:w-2/4">
            <label class="text-gray-700"
                >Discount ({{ toCurrency(SaleStore.discount).symbol }})</label
            >
            <InputCurrency
                @onBlur="({ value }) => setDiscount(value)"
                @onKeyup="({ value }) => setDiscount(value)"
                class="rounded"
                :value="toCurrency(SaleStore.discount).withoutSymbol"
            />
        </div>

        <div class="w-3/4 space-y-1 lg:w-2/4">
            <label class="text-gray-700"
                >Pay ({{
                    toCurrency(SaleStore.customer_pay_money).symbol
                }})</label
            >
            <InputCurrency
                @onBlur="({ value }) => setCustomerPay(value)"
                @onKeyup="({ value }) => setCustomerPay(value)"
                placeholder="Amount"
                class="rounded"
                :value="toCurrency(SaleStore.customer_pay_money).withoutSymbol"
            />
            <Alert
                @onClose="errors_message.customer_pay_money = null"
                :message="errors_message.customer_pay_money"
            />
        </div>

        <div class="flex space-x-2">
            <Button
                @click="clear()"
                :disabled="!SaleStore.products.datasets.length"
                class="px-2 py-1 text-black bg-yellow-500 rounded hover:bg-yellow-500/90 focus:ring-yellow-500/25 focus:bg-yellow-500/90 disabled:bg-yellow-500/75"
                >CLEAR</Button
            >
            <Button
                @click="pay()"
                :disabled="!SaleStore.products.datasets.length"
                class="px-2 py-1 rounded disabled:bg-indigo-900/75"
                ><span class="whitespace-nowrap">PAY & PRINT</span></Button
            >
        </div>
    </main>
</template>

<script setup>
import Alert from '../../Alert.vue';
import Button from '../../Button.vue';
import InputCurrency from '../../InputCurrency.vue';
import { reactive } from 'vue';
import { toCurrency } from '../../../Helpers';
import { fetchAsJSON } from '../../../Mixins/Fetch';
import { useSale } from '../../../Stores/Sale.js';
import { SwalTailwind } from '../../../Mixins/Swal.js';
import { Inertia } from '@inertiajs/inertia';

const SaleStore = useSale();

const errors_message = reactive({
    customer_pay_money: '',
    discount: ''
});

function setDiscount(amount) {
    SaleStore.$patch({
        discount: toCurrency(amount).number
    });
}

function setCustomerPay(amount) {
    SaleStore.$patch({
        customer_pay_money: toCurrency(amount).number
    });
}

function pay() {
    const validate = () => {
        if (
            parseFloat(SaleStore.customer_pay_money) <
            parseFloat(SaleStore.sum_net_price)
        ) {
            errors_message.customer_pay_money =
                'Pay amount must be more than or equal to the Summary';
            return false;
        }

        return true;
    };
    if (!validate()) return;

    SwalTailwind.fire({
        title: 'Confirm and Pay',
        text: 'Make sure the data is correct.',
        showCancelButton: true,
        confirmButtonText: 'Continue'
    }).then((r) => {
        if (r.isConfirmed) {
            fetchAsJSON(route('sales.store'), {
                body: {
                    ...SaleStore.$state,
                    products: SaleStore.products.datasets
                }
            }).then(({ response, json }) => {
                if (!response.ok)
                    return SwalTailwind.fire({
                        title: json.error_message,
                        icon: 'error',
                        showConfirmButton: false
                    });

                SwalTailwind.fire({
                    title: json.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((r) => {
                    if (r.dismiss || r.isConfirmed || r.isDenied) {
                        SaleStore.$reset();
                        SaleStore.products.$reset();
                        window.open(json.redirect, '_blank').focus();
                    }
                });

                //
            });
        }
    });
}

function clear() {
    SwalTailwind.fire({
        title: 'Clear confirmation',
        text: 'Are u sure want to Clear?',
        showCancelButton: true
    }).then((r) => {
        if (r.isConfirmed) {
            SaleStore.$reset();
            SaleStore.products.$reset();
        }
    });
}
</script>
