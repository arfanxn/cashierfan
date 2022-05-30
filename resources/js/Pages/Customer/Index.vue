<template>

    <Head>
        <title>Customers</title>
        <meta name="Customers" content="list of customers" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class=" fas fa-bag-shopping" />
                <h1 class="text-lg font-semibold">CUSTOMERS</h1>
            </template>

            <main>
                <div class="flex">
                    <ButtonLink :href="route(`customers.create`)" class="flex items-center px-2 space-x-1 rounded-l">
                        <font-awesome-icon icon="fas fa-circle-plus"></font-awesome-icon>
                        <span class="hidden lg:inline-block">NEW</span>
                    </ButtonLink>
                    <Input placeholder="Search by customer name" type="text" class="placeholder:italic" />
                    <Button class="flex px-2 rounded-r">
                        <font-awesome-icon icon="fas fa-magnifying-glass" class="self-center"></font-awesome-icon>
                    </Button>
                </div>



                <div class="relative mt-4 overflow-x-auto shadow">
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
                            <tr v-for="(item, index) in [1, 2, 3, 4, 5, 6, 7]" :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300">
                                <td class="px-4 py-4 text-gray-900 border border-slate-500 ">
                                    Lorem ipsum dolor sit amet consectetur adipisicing.
                                </td>
                                <td
                                    class="px-4 py-4 font-medium text-gray-900 border border-slate-500 whitespace-nowrap">
                                    {{ randInt(100000000000, 999999999999) }}
                                </td>
                                <td class="px-4 py-4 border border-slate-500">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut qui officia non.
                                </td>
                                <td
                                    class="py-4 px-2 space-x-1  border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap">
                                    <Link :href="route(`customers.edit`, 1)"
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 bg-blue-600 rounded hover:bg-blue-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-600/25 focus:bg-blue-600/90">
                                    <font-awesome-icon icon="fas fa-pencil"></font-awesome-icon>
                                    <span class="hidden lg:inline-block">EDIT</span>
                                    </Link>
                                    <Link
                                        class="px-2 py-1 space-x-1 text-white transition duration-300 bg-red-600 rounded hover:bg-red-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-600/25 focus:bg-red-600/90">
                                    <font-awesome-icon icon="fas fa-trash-can"></font-awesome-icon>
                                    <span class="hidden lg:inline-block">DELETE</span>
                                    </Link>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-row-reverse w-full mt-4">
                    <ButtonPagination class="basis-full lg:basis-3/12" :currentPage="1" />
                </div>
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import ButtonPagination from "../../Components/ButtonPagination.vue";
import ButtonLink from "../../Components/ButtonLink.vue";
import Input from "../../Components/Input.vue";
import { Link, Head } from '@inertiajs/inertia-vue3'
import { randInt } from "../../Helpers";

</script>