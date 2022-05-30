<template>

    <Head>
        <title>Users</title>
        <meta name="users" content="list of users" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class=" fas fa-users" />
                <h1 class="text-lg font-semibold">USERS</h1>
            </template>

            <main class="py-2">
                <div class="flex">
                    <ButtonLink :href="route(`users.create`)" class="flex items-center px-2 space-x-1 rounded-l">
                        <font-awesome-icon icon="fas fa-circle-plus"></font-awesome-icon>
                        <span class="hidden lg:inline-block">NEW</span>
                    </ButtonLink>
                    <Input placeholder="Search users" type="text" class="placeholder:italic" />
                    <Button class="flex px-2 rounded-r">
                        <font-awesome-icon icon="fas fa-magnifying-glass" class="self-center"></font-awesome-icon>
                    </Button>
                </div>



                <div class="relative mt-4 overflow-x-auto shadow">
                    <table class="w-full text-sm text-left text-black border border-collapse border-gray-500 ">
                        <thead class="text-xs text-white uppercase bg-indigo-900">
                            <tr>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Avatar
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Fullname
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Email
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Phone Number
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500 w-min">
                                    <div class="flex items-center space-x-1"
                                        :class="{ 'justify-center': !showUserAddress, 'w-64 lg:w-full': showUserAddress }">
                                        <input @change="showUserAddress = !showUserAddress" type="checkbox"
                                            id="radioShowUserAddress" class="default:ring-4 " />
                                        <label v-show="showUserAddress" for="radioShowUserAddress">Address</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Roles
                                </th>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in [1, 2, 3, 4, 5, 6, 7]" :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300">
                                <td class="w-16 h-16 text-gray-900 align-top border border-slate-500">
                                    <img class="w-full h-full bg-center bg-no-repeat bg-cover aspect-square"
                                        src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                                        alt="">
                                </td>
                                <td class="px-4 py-4 text-gray-900 align-top border border-slate-500 whitespace-nowrap">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing.
                                </td>
                                <td class="px-4 py-4 text-gray-900 align-top border border-slate-500">
                                    Loremipsum.@gm.com
                                </td>
                                <td class="px-4 py-4 align-top border border-slate-500 whitespace-nowrap">
                                    {{ randInt(10000000000, 999999999999) }}
                                </td>
                                <td class="px-4 py-4 font-medium text-gray-900 align-top border border-slate-500">
                                    <p v-show="showUserAddress" class="break-words">Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit.
                                        Ullam nisi, quidem animi
                                        non deleniti temporibus eaque. Aperiam quos nihil culpa aliquid, vitae hic fuga
                                        quo
                                        accusantium molestiae sit corporis similique.</p>
                                </td>
                                <td class="px-4 py-4 align-top border border-slate-500 whitespace-nowrap">
                                    Member
                                </td>
                                <td
                                    class=" py-4 px-2 space-x-1  border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap align-top">
                                    <Link :href="route(`users.edit`, 1)"
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
import ButtonLink from "../../Components/ButtonLink.vue";
import ButtonPagination from "../../Components/ButtonPagination.vue";
import Input from "../../Components/Input.vue";
import { Link, Head } from '@inertiajs/inertia-vue3'
import { randInt } from "../../Helpers";
import { ref } from "vue";

const showUserAddress = ref(false); 
</script>