<template>
    <main class="space-y-1">
        <label class="text-gray-700">Customer</label>
        <Input
            @onInput="
                ({ value }) => {
                    state.customers.meta.keyword = value;
                    state.customers.meta.displayIndex = true;
                }
            "
            @keyup.enter="
                () => {
                    state.customers.meta.displayIndex = true;
                }
            "
            @keyup.esc="state.customers.meta.displayIndex = false"
            @focus="state.customers.meta.displayIndex = true"
            @keydown.down="selectByArrowKey(0)"
            :value="SaleStore.$state.customer?.name"
            placeholder="Enter registered Customer or create on Customer Menu"
            class="rounded disabled:bg-gray-200 disabled:text-white"
        />

        <Dropdown
            menuContainerClassname="lg:max-h-52 overflow-y-scroll"
            v-show="
                state.customers.meta.displayIndex &&
                state.customers.meta.keyword.length >= 2
            "
            title="List of customers"
            @onClose="state.customers.meta.displayIndex = false"
            @onScroll="
                ({ isMaxBottom }) => {
                    if (isMaxBottom) fetchCustomers();
                }
            "
        >
            <template v-slot:menu>
                <li
                    v-show="!state.customers.datasets.length"
                    class="block w-full px-2 py-4 text-center text-black bg-white border"
                >
                    <span>No customers found.</span>
                </li>

                <li
                    v-for="(customer, index) in state.customers.datasets"
                    :key="index"
                    @click="
                        SaleStore.$state?.customer?.id === customer.id
                            ? removeCustomer()
                            : insertCustomer(customer)
                    "
                    @keyup.enter="
                        SaleStore.$state?.customer?.id === customer.id
                            ? removeCustomer()
                            : insertCustomer(customer)
                    "
                    @keydown.down="selectByArrowKey(index + 1)"
                    @keydown.up="selectByArrowKey(index - 1)"
                    @keyup.esc="state.customers.meta.displayIndex = false"
                    @focus="state.customers.meta.isIndexFocus = true"
                    @blur="state.customers.meta.isIndexFocus = false"
                    class="w-full px-2 py-1 text-black bg-white border cursor-pointer hover:text-white focus:text-white focus:outline-none"
                    :class="{
                        // if selected
                        'bg-gray-500/75 text-white hover:bg-red-600/75 focus:bg-red-600/75':
                            SaleStore.$state?.customer?.id === customer.id,
                        // if not selected
                        'hover:bg-indigo-900/75 focus:bg-indigo-900/75':
                            SaleStore.$state?.customer?.id !== customer.id,
                        // if another elems OR this elem is focused disable the hover effect on the related elems
                        'hover:bg-white hover:text-black hover:opacity-100':
                            state.customers.meta.isIndexFocus
                    }"
                    :ref="
                        (elem) => {
                            if (elem) elements.customers[index] = elem;
                        }
                    "
                    tabindex="0"
                >
                    <div class="flex justify-between">
                        <span>{{
                            customer.name.toString().substring(0, 25)
                        }}</span>
                        <small
                            v-show="
                                SaleStore.$state?.customer?.id === customer.id
                            "
                            class="block hover:hidden focus:hidden"
                            >Selected</small
                        >
                    </div>
                    <small class="self-start">{{
                        customer.phone_number
                    }}</small>
                </li>
            </template>
        </Dropdown>
    </main>
</template>

<script setup>
import Alert from '../../Alert.vue';
import Input from '../../Input.vue';
import Dropdown from '../../Dropdown.vue';
import { reactive, watch, onBeforeUpdate } from 'vue';
import { fetchAsJSON } from '../../../Mixins/Fetch.js';
import { useSale } from '../../../Stores/Sale.js';

const SaleStore = useSale();

// handle reactive html
const elements = reactive({
    customers: []
});
onBeforeUpdate(() => {
    elements.customers = [];
});
// end of handle reactive html

const state = reactive({
    customers: {
        datasets: [],
        meta: {
            currentPage: null,
            keyword: ``,
            displayIndex: false,
            isIndexFocus: false
        }
    }
});

watch(
    () => state.customers.meta.keyword,
    (newVal) => {
        state.customers.datasets = [];
        state.customers.meta.currentPage = null;

        SaleStore.$patch({ customer: null });

        // if the keyword length more than or equal to 2 chars then fetch the Customers
        if (newVal.length >= 2) {
            fetchCustomers();
        }
    }
);
function fetchCustomers() {
    const url = new URL(route(`customers.index`));
    url.searchParams.append('keyword', state.customers.meta.keyword);
    url.searchParams.append(
        'page',
        state.customers.meta.currentPage
            ? state.customers.meta.currentPage + 1
            : 1
    );

    fetchAsJSON(url, {
        method: 'GET'
    }).then(({ response, json }) => {
        if (response.ok) {
            if (
                state.customers.meta.currentPage != json.customers.current_page
            ) {
                state.customers.datasets = state.customers.datasets.concat(
                    json.customers.data
                );
                state.customers.meta.currentPage = json.customers.current_page;
            } else if (
                state.customers.meta.currentPage ==
                    json.customers.current_page &&
                json.customers.current_page == 1
            ) {
                state.customers.datasets = json.customers.data;
            }
        }
    });
}
function insertCustomer(customer) {
    SaleStore.$patch({ customer });
    state.customers.meta.displayIndex = false;
}
function removeCustomer() {
    SaleStore.$patch({ customer: null });
    state.customers.meta.displayIndex = false;
}

function selectByArrowKey(index) {
    if (!elements.customers[index] || index < 0) return;
    elements.customers[index].focus();
}
</script>
