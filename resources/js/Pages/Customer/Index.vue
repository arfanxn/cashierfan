<template>

    <Head>
        <title>Customers</title>
        <meta name="Customers" content="list of customers" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class=" fas fa-user-circle" />
                <h1 class="text-lg font-semibold">CUSTOMERS</h1>
            </template>

            <main class="py-2 space-y-1 md:space-y-2 lg:space-y-3">
                <div class="flex">
                    <ButtonLink :href="route(`customers.create`)" class="flex items-center px-2 space-x-1 rounded-l">
                        <font-awesome-icon icon="fas fa-circle-plus"></font-awesome-icon>
                        <span class="hidden lg:inline-block">NEW</span>
                    </ButtonLink>
                    <Input @onInput="({ value }) => (searchCustomerKeyword = value)" :value="searchCustomerKeyword"
                        @keyup.enter="searchCustomer()" @blur="searchCustomer()"
                        placeholder="Search by customer name, phone number or address" type="text"
                        class="placeholder:italic" />
                    <Button class="flex px-2 rounded-r" @onClick="searchCustomer()">
                        <font-awesome-icon icon="fas fa-magnifying-glass" class="self-center"></font-awesome-icon>
                    </Button>
                </div>

                <Alert type="success" :message="$page.props?.flash?.message" />

                <div class="relative overflow-x-auto shadow">
                    <table class="w-full text-sm text-left text-black border border-collapse border-gray-500 ">
                        <thead class="text-xs text-white uppercase bg-indigo-900">
                            <tr>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Fullname
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Phone Number
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Address
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(customer, index) in props.customers.data" :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300">
                                <td class="px-4 py-4 text-gray-900 border border-slate-500 ">
                                    <span>{{ customer.name }}</span>
                                </td>
                                <td
                                    class="px-4 py-4 font-medium text-gray-900 border border-slate-500 whitespace-nowrap">
                                    <span>{{ customer.phone_number }}</span>
                                </td>
                                <td class="px-4 py-4 border border-slate-500">
                                    <span>{{ customer.address }}</span>
                                </td>
                                <td
                                    class="py-4 px-2 space-x-1  border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap">
                                    <Link :href="route(`customers.edit`, customer.id)"
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 bg-blue-600 rounded hover:bg-blue-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-600/25 focus:bg-blue-600/90">
                                    <font-awesome-icon icon="fas fa-pencil"></font-awesome-icon>
                                    <span class="hidden lg:inline-block">EDIT</span>
                                    </Link>
                                    <Button @onClick="deleteCustomer(customer)"
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 bg-red-600 rounded hover:bg-red-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-600/25 focus:bg-red-600/90">
                                        <font-awesome-icon icon="fas fa-trash-can"></font-awesome-icon>
                                        <span class="hidden lg:inline-block">DELETE</span>
                                    </Button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-row-reverse w-full">
                    <ButtonPagination class="basis-full lg:basis-3/12" :currentPage="props.customers?.current_page" />
                </div>
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Alert from "../../Components/Alert.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import ButtonPagination from "../../Components/ButtonPagination.vue";
import ButtonLink from "../../Components/ButtonLink.vue";
import Input from "../../Components/Input.vue";
import { Link, Head } from '@inertiajs/inertia-vue3'
import { tap } from "../../Helpers";
import { ref, defineProps } from "vue"
import { Inertia } from "@inertiajs/inertia";
import { SwalTailwind } from "../../Mixins/Swal";

const searchCustomerKeyword = ref(
    tap(new URL(window.location.href), url => url.searchParams.get(`keyword`))
);

const props = defineProps(['customers']);

function searchCustomer() {
    Inertia.get(route('customers.index'), {
        "keyword": searchCustomerKeyword.value,
    });
}

function deleteCustomer(customer) {
    SwalTailwind.fire({
        title: `Delete confirmation`,
        text: `Are you sure you want to delete customer "${customer.name}" ?`,
        allowEnterKey: false,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
    }).then(result => {
        if (result.isConfirmed) {
            Inertia.delete(route('customers.destroy', customer.id));
        }
    });
}
</script>