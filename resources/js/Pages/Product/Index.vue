<template>
    <Head>
        <title>Products</title>
        <meta name="Products" content="list of products" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class="fas fa-bag-shopping" />
                <h1 class="text-lg font-semibold">PRODUCTS</h1>
            </template>

            <main class="py-2 space-y-1 md:space-y-2 lg:space-y-3">
                <div class="flex">
                    <ButtonLink
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `products.create`
                            )
                        "
                        :href="route(`products.create`)"
                        class="flex items-center px-2 space-x-1 rounded-l"
                    >
                        <font-awesome-icon
                            icon="fas fa-circle-plus"
                        ></font-awesome-icon>
                        <span class="hidden lg:inline-block">NEW</span>
                    </ButtonLink>
                    <Input
                        :class="{
                            'rounded-l':
                                !$page.props?.auth?.user?.permissions?.includes(
                                    `products.create`
                                )
                        }"
                        @onInput="({ value }) => (products.keyword = value)"
                        :value="products.keyword"
                        @keyup.enter="searchProducts()"
                        @blur="searchProducts()"
                        placeholder="Search products by barcode, or name."
                        type="text"
                        class="placeholder:italic"
                    />
                    <Button
                        class="flex px-2 rounded-r"
                        @onCLick="searchProducts()"
                    >
                        <font-awesome-icon
                            icon="fas fa-magnifying-glass"
                            class="self-center"
                        ></font-awesome-icon>
                    </Button>
                </div>

                <Alert type="success" :message="$page.props?.flash?.message" />

                <div class="relative mt-4 overflow-x-auto shadow">
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
                                            'w-64 lg:w-full':
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
                                    Stocks
                                </th>
                                <th
                                    v-if="
                                        $page.props?.auth?.user?.permissions?.includes(
                                            `products.edit`
                                        ) ||
                                        $page.props?.auth?.user?.permissions?.includes(
                                            `products.delete`
                                        )
                                    "
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(product, index) in props.products.data"
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
                                    <span>{{ product.stock }}</span>
                                </td>
                                <td
                                    v-if="
                                        $page.props?.auth?.user?.permissions?.includes(
                                            `products.edit`
                                        ) ||
                                        $page.props?.auth?.user?.permissions?.includes(
                                            `products.delete`
                                        )
                                    "
                                    class="align-top py-4 px-2 space-x-1 border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap"
                                >
                                    <Link
                                        v-if="
                                            $page.props?.auth?.user?.permissions?.includes(
                                                `products.edit`
                                            )
                                        "
                                        :href="
                                            route(`products.edit`, product.id)
                                        "
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 bg-blue-600 rounded hover:bg-blue-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-600/25 focus:bg-blue-600/90"
                                    >
                                        <font-awesome-icon
                                            icon="fas fa-pencil"
                                        ></font-awesome-icon>
                                        <span class="hidden lg:inline-block"
                                            >EDIT</span
                                        >
                                    </Link>
                                    <Button
                                        v-if="
                                            $page.props?.auth?.user?.permissions?.includes(
                                                `products.delete`
                                            )
                                        "
                                        @onClick="deleteProduct(product)"
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 bg-red-600 rounded hover:bg-red-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-600/25 focus:bg-red-600/90"
                                    >
                                        <font-awesome-icon
                                            icon="fas fa-trash-can"
                                        ></font-awesome-icon>
                                        <span class="hidden lg:inline-block"
                                            >DELETE</span
                                        >
                                    </Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-row-reverse w-full mt-4">
                    <ButtonPagination
                        class="basis-full lg:basis-3/12"
                        :currentPage="props.products.current_page"
                    />
                </div>
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import JsBarcode from 'jsbarcode';
import AuthLayout from '../../Layouts/AuthLayout.vue';
import Alert from '../../Components/Alert.vue';
import Card from '../../Components/Card.vue';
import Button from '../../Components/Button.vue';
import ButtonPagination from '../../Components/ButtonPagination.vue';
import ButtonLink from '../../Components/ButtonLink.vue';
import Input from '../../Components/Input.vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import { randInt, tap, toCurrency } from '../../Helpers';
import { reactive, defineProps, onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { SwalTailwind } from '../../Mixins/Swal';

const props = defineProps(['products']);

const products = reactive({
    showDescription: false,
    keyword: tap(new URL(window.location.href), (url) =>
        url.searchParams.get(`keyword`)
    )
});

onMounted(() => {
    JsBarcode('.barcode').init();
});

// functions //
function searchProducts() {
    Inertia.get(route('products.index'), {
        keyword: products.keyword
    });
}

function deleteProduct(product) {
    SwalTailwind.fire({
        title: `Delete confirmation`,
        text: `Are you sure you want to delete product "${product.name}" ?`,
        allowEnterKey: false,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.delete(route('products.destroy', product.id));
        }
    });
}
</script>
