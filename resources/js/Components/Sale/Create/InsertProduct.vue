<template>
    <main class="p-4 space-y-1 bg-white rounded lg:space-y-3 md:space-y-2">
        <div class="space-y-1">
            <div class="flex items-center bg-indigo-900 rounded">
                <font-awesome-icon
                    icon="fas fa-barcode"
                    class="px-2 py-1 text-white"
                />
                <Input
                    :value="fields.keyword"
                    @onInput="({ value }) => (fields.keyword = value)"
                    @keyup.enter="
                        state.products_search.meta.displayIndex = true
                    "
                    @keyup.esc="state.products_search.meta.displayIndex = false"
                    @focus="state.products_search.meta.displayIndex = true"
                    @keydown.down="selectByArrowKey(0)"
                    placeholder="Scan or input by Name/Barcode"
                    class="rounded-r"
                />
            </div>

            <Dropdown
                classname="lg:-right-96"
                menuContainerClassname="lg:max-h-96"
                v-show="
                    state.products_search.meta.displayIndex &&
                    fields.keyword.length >= 2
                "
                title="List of products"
                @onClose="state.products_search.meta.displayIndex = false"
                @onScroll="
                    ({ isMaxBottom }) => {
                        if (isMaxBottom) fetchProducts();
                    }
                "
            >
                <template v-slot:menu>
                    <li
                        v-show="!state.products_search.datasets.length"
                        class="block w-full px-2 py-4 text-center text-black bg-white border"
                    >
                        <span>No products found.</span>
                    </li>

                    <li
                        v-for="(product, index) in state.products_search
                            .datasets"
                        :key="index"
                        @click="preview(product)"
                        @keyup.enter="preview(product)"
                        @keydown.down="selectByArrowKey(index + 1)"
                        @keydown.up="selectByArrowKey(index - 1)"
                        @keyup.esc="
                            state.products_search.meta.displayIndex = false
                        "
                        @focus="state.products_search.meta.isIndexFocus = true"
                        @blur="state.products_search.meta.isIndexFocus = false"
                        class="flex justify-between w-full px-2 py-1 text-black bg-white border cursor-pointer focus:outline-none hover:bg-indigo-900/75 focus:bg-indigo-900/75 hover:text-white focus:text-white"
                        :class="{
                            // if another elems OR this elem is focused disable the hover effect on the related elems
                            'hover:bg-white hover:text-black hover:opacity-100':
                                state.products_search.meta.isIndexFocus
                        }"
                        :ref="
                            (elem) => {
                                if (elem)
                                    elements.products_search[index] = elem;
                            }
                        "
                        tabindex="0"
                    >
                        <ul class="flex items-start justify-start space-x-2">
                            <li class="w-20 min-h-20">
                                <img
                                    class="w-full h-full bg-center bg-no-repeat bg-cover aspect-square"
                                    :src="product.image"
                                />
                            </li>
                            <li>
                                <span>{{ product.name }}</span>
                            </li>
                        </ul>
                        <ul class="text-right">
                            <span class="block">{{
                                toCurrency(product.net_price).output
                            }}</span>
                            <small class="block">{{
                                String(product?.barcode).toUpperCase()
                            }}</small>
                            <small class="font-semibold"
                                >Stock : {{ product.stock }}</small
                            >
                        </ul>
                    </li>
                </template>
            </Dropdown>
        </div>

        <div v-if="ProductStore.id" class="space-y-1 bg-white">
            <h5 class="text-gray-700">Preview</h5>
            <div class="flex justify-between border rounded">
                <img
                    class="bg-center bg-no-repeat bg-cover w-28 min-h-28 aspect-square"
                    :src="ProductStore.image"
                />
                <div class="px-2 py-1 space-y-1 text-right">
                    <span class="block">{{ ProductStore.name }}</span>
                    <div class="space-x-1">
                        <small class="">
                            {{
                                ProductStore.barcode?.toString()?.toUpperCase()
                            }}
                        </small>
                        <hr class="inline p-0 m-0 border-x border-slate-500" />
                        <small>
                            Stock&nbsp;left&nbsp;:&nbsp;
                            {{ state.product_preview.meta.stock_left }}
                            <!-- <span
                                v-if="
                                    !!SaleStore.products.getById(
                                        ProductStore.id
                                    )
                                "
                                >{{
                                    SaleStore.products.getStockLeft(
                                        ProductStore.id,
                                        fields.quantity
                                    )
                                }}
                            </span>
                            <span v-else>{{
                                parseInt(ProductStore.stock) -
                                parseInt(fields.quantity)
                            }}</span> -->
                        </small>
                    </div>
                    <small class="block">
                        {{
                            toCurrency(ProductStore.net_price).output +
                            '&nbsp;x&nbsp;' +
                            fields.quantity
                        }}
                    </small>
                    <span class="block"
                        >=&nbsp;{{
                            toCurrency(
                                ProductStore.getNetPriceMultipleBy(
                                    fields.quantity
                                )
                            ).output
                        }}
                    </span>
                </div>
            </div>
        </div>

        <div class="space-y-1">
            <label class="text-gray-700" for="inpQty">Quantity</label>
            <Input
                :disabled="!ProductStore.id"
                :value="fields.quantity"
                @onInput="
                    ({ value }) => {
                        v$.quantity.$touch(); // live validation
                        fields.quantity = value; // set the value
                    }
                "
                @keyup.enter="add()"
                id="inpQty"
                placeholder="1"
                type="number"
                class="rounded disabled:bg-gray-200 disabled:text-black"
                min="1"
            />
            <!--   v-show="
                    ProductStore.id &&
                    isset(() => v$.quantity.$errors[0].$message)
                " -->
            <Alert
                @onClose="v$.quantity.$reset()"
                :message="isset(() => v$.quantity.$errors[0].$message)"
            />
        </div>

        <div class="flex justify-end space-x-1">
            <Button
                :disabled="!ProductStore.id"
                @click.prevent="clear()"
                type="button"
                class="px-2 py-1 text-black bg-yellow-500 rounded hover:bg-yellow-500/90 focus:ring-yellow-500/25 focus:bg-yellow-500/90 disabled:bg-yellow-500/75"
                >CLEAR</Button
            >
            <Button
                :disabled="!ProductStore.id"
                @click.prevent="add()"
                type="button"
                class="px-2 py-1 rounded disabled:bg-indigo-900/75"
                >ADD</Button
            >
        </div>
    </main>
</template>

<script setup>
import Alert from '../../Alert.vue';
import Card from '../../Card.vue';
import Button from '../../Button.vue';
import Input from '../../Input.vue';
import Dropdown from '../../Dropdown.vue';
import { tap, toCurrency, isset } from '../../../Helpers';
import { reactive, watch, onBeforeUpdate, computed as vueComputed } from 'vue';
import useVuelidate from '@vuelidate/core';
import { required, minValue, numeric, helpers } from '@vuelidate/validators';
import { fetchAsJSON } from '../../../Mixins/Fetch.js';
import { useSale } from '../../../Stores/Sale.js';
import { useProduct } from '../../../Stores/Product'; // singular (data)
import { useProducts } from '../../../Stores/Products'; // plural (datasets)
const ProductStore = useProduct();
const ProductsStore = useProducts();
const SaleStore = useSale();

const state = reactive({
    products_search: {
        datasets: [],
        meta: {
            currentPage: 0,
            displayIndex: false,
            isIndexFocus: false
        }
    },
    product_preview: {
        meta: {
            stock_left: vueComputed(() => {
                const productOnStore = SaleStore.products.getById(
                    ProductStore.id
                );

                return productOnStore
                    ? parseInt(productOnStore['stock']) -
                          (parseInt(productOnStore['quantity']) +
                              parseInt(fields.quantity))
                    : parseInt(ProductStore.stock) - parseInt(fields.quantity);
            })
        }
    }
});

// field validations
const fields = reactive({
    keyword: '',
    quantity: 1
});
const rules = vueComputed(() => ({
    quantity: {
        required,
        numeric,
        minValue: minValue(1),
        maxValueRef: helpers.withMessage(
            'Out of stock products',
            (value) =>
                state.product_preview.meta.stock_left <= -1 ? false : true
            // value <=
            // isset(
            //     SaleStore.products.getStockLeft(
            //         ProductStore.id,
            //         fields.quantity
            //     ),
            //     parseInt(ProductStore.stock)
            // )
        )
    }
}));
const v$ = useVuelidate(rules, fields);
// end of  validations

// handle reactive html
const elements = reactive({
    products_search: []
});
onBeforeUpdate(() => {
    elements.products_search = [];
});
function selectByArrowKey(index) {
    if (!elements.products_search[index] || index < 0) return;
    elements.products_search[index].focus();
}
// end of handle reactive html

watch(
    // if the keyword updated reset the products pagination and refetch the products
    () => fields.keyword,
    (currentVal) => {
        state.products_search.datasets = [];
        state.products_search.meta.currentPage = null;

        // if the keyword length more than or equal to 2 chars then fetch the products
        if (currentVal.length >= 2) fetchProducts();
    }
);

function fetchProducts() {
    const currentPage = (page = null) => {
        if (!page) return parseInt(state.products_search.meta.currentPage);
        return (state.products_search.meta.currentPage = page);
    };

    const url = new URL(route(`products.index`));
    url.searchParams.append('keyword', fields.keyword);
    url.searchParams.append('page', currentPage() ? currentPage() + 1 : 1);

    fetchAsJSON(url, {
        method: 'GET'
    }).then(({ response, json }) => {
        if (response.ok) {
            if (currentPage() != json.products.current_page) {
                state.products_search.datasets =
                    state.products_search.datasets.concat(json.products.data);
                currentPage(json.products.current_page);
            } else if (json.products.current_page == 1) {
                state.products_search.datasets = json.products.data;
            }
        }
    });
}

function preview(product) {
    fields.keyword = '';
    state.products_search.meta.displayIndex = false;
    ProductStore.fill(product);
}
async function add() {
    const validator = await v$.value.$validate();

    if (!validator) return;

    SaleStore.addProduct({ ...ProductStore.$state, quantity: fields.quantity });

    clear();
}

function clear() {
    ProductStore.$reset();
    fields.keyword = '';
    fields.quantity = 1;
    v$.value.$reset();

    state.products_search.meta.displayIndex = false;
    state.products_search.datasets = [];
}
</script>
