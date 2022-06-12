<template>

    <Head>
        <title>Products</title>
        <meta name="Products" content="list of products" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class=" fas fa-bag-shopping" />
                <h1 class="text-lg font-semibold">PRODUCTS</h1>
            </template>

            <main class="py-2 space-y-1 md:space-y-2 lg:space-y-3">
                <div class="flex">
                    <ButtonLink :href="route(`products.create`)" class="flex items-center px-2 space-x-1 rounded-l">
                        <font-awesome-icon icon="fas fa-circle-plus"></font-awesome-icon>
                        <span class="hidden lg:inline-block">NEW</span>
                    </ButtonLink>
                    <Input @onInput="({ value }) => (products.keyword = value)" :value="products.keyword"
                        @keyup.enter="searchProduct()" @blur="searchProduct()"
                        placeholder="Search products by barcode, or name." type="text" class="placeholder:italic" />
                    <Button class="flex px-2 rounded-r" @onCLick="searchProduct()">
                        <font-awesome-icon icon="fas fa-magnifying-glass" class="self-center"></font-awesome-icon>
                    </Button>
                </div>

                <Alert type="success" :message="$page.props?.flash?.message" />

                <div class="relative mt-4 overflow-x-auto shadow">
                    <table class="w-full text-sm text-left text-black border border-collapse border-gray-500 ">
                        <thead class="text-xs text-white uppercase bg-indigo-900">
                            <tr>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Barcode/ID
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Product Image
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Product name
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500 w-min">
                                    <div class="flex items-center space-x-1" :class="{
                                        'justify-center': !products.showDescription,
                                        'w-64 lg:w-full': products.showDescription
                                    }">
                                        <input @change="products.showDescription = !products.showDescription"
                                            type="checkbox" id="radioShowProdDesc" class="default:ring-4 " />
                                        <label v-show="products.showDescription" for="radioShowProdDesc">Product
                                            Description</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Gross Price
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Net Price
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Stocks
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in props.products.data" :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300">
                                <td
                                    class="py-4 font-semibold text-gray-900 align-top border border-slate-500 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        <svg class="h-auto p-0 m-0 barcode w-52" jsbarcode-format="CODE39"
                                            jsbarcode-width="1"
                                            :jsbarcode-value="product.code || product.barcode || product.id"
                                            jsbarcode-textmargin="0" jsbarcode-fontoptions="bold">
                                        </svg>
                                    </div>
                                </td>
                                <td
                                    class="w-24 h-24 font-medium text-gray-900 align-top border border-slate-500 md:w-52 md:h-52">
                                    <img class="w-full h-full bg-center bg-no-repeat bg-cover " :src="product.image"
                                        alt="">
                                </td>
                                <td class="px-4 py-4 font-medium text-gray-900 align-top border border-slate-500">
                                    <span>{{ product.name }}</span>
                                </td>
                                <td class="px-4 py-4 font-medium text-gray-900 align-top border border-slate-500">
                                    <p v-show="products.showDescription" class="break-words">
                                        {{ product.description || "No Description" }}</p>
                                </td>
                                <td class="px-4 py-4 align-top border border-slate-500">
                                    <span>{{ toCurrency(product.gross_price).output }}</span>
                                </td>
                                <td class="px-4 py-4 align-top border border-slate-500">
                                    <span>{{ toCurrency(product.net_price).output }}</span>
                                </td>
                                <td class="px-4 py-4 align-top border border-slate-500">
                                    <span>{{ product.stock }}</span>
                                </td>
                                <td
                                    class="align-top py-4 px-2 space-x-1  border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap">
                                    <Link :href="route(`products.edit`, product.id)"
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 bg-blue-600 rounded hover:bg-blue-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-600/25 focus:bg-blue-600/90">
                                    <font-awesome-icon icon="fas fa-pencil"></font-awesome-icon>
                                    <span class="hidden lg:inline-block">EDIT</span>
                                    </Link>
                                    <Button @onClick="deleteProduct(product)"
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 bg-red-600 rounded hover:bg-red-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-600/25 focus:bg-red-600/90">
                                        <font-awesome-icon icon="fas fa-trash-can"></font-awesome-icon>
                                        <span class="hidden lg:inline-block">DELETE</span>
                                    </Button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-row-reverse w-full mt-4">
                    <ButtonPagination class="basis-full lg:basis-3/12" :currentPage="props.products.current_page" />
                </div>
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import JsBarcode from 'jsbarcode';
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Alert from "../../Components/Alert.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import ButtonPagination from "../../Components/ButtonPagination.vue";
import ButtonLink from "../../Components/ButtonLink.vue";
import Input from "../../Components/Input.vue";
import { Link, Head } from '@inertiajs/inertia-vue3'
import { randInt, tap, toCurrency } from "../../Helpers";
import { reactive, defineProps, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { SwalTailwind } from "../../Mixins/Swal";

const props = defineProps(["products"]);

const products = reactive({
    "showDescription": false,
    "keyword": tap(new URL(window.location.href), url => url.searchParams.get(`keyword`))
})

onMounted(() => {
    JsBarcode(".barcode").init();
})






// functions //
function searchProduct() {
    Inertia.get(route('products.index'), {
        "keyword": products.keyword,
    });
}

function deleteProduct(product) {
    SwalTailwind.fire({
        title: `Delete confirmation`,
        text: `Are you sure you want to delete product "${product.name}" ?`,
        allowEnterKey: false,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
    }).then(result => {
        if (result.isConfirmed) {
            Inertia.delete(route('products.destroy', product.id));
        }
    });
}

</script>