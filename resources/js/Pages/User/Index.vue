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

            <main class="py-2 space-y-1 md:space-y-2 lg:space-y-3">
                <div class="flex">
                    <ButtonLink :href="route(`users.create`)" class="flex items-center px-2 space-x-1 rounded-l">
                        <font-awesome-icon icon="fas fa-circle-plus"></font-awesome-icon>
                        <span class="hidden lg:inline-block">NEW</span>
                    </ButtonLink>
                    <Input @onInput="({ value }) => (searchUserKeyword = value)" :value="searchUserKeyword"
                        @keyup.enter="searchUser()" @blur="searchUser()"
                        placeholder="Search users by name, email ,phone number or role." type="text"
                        class="placeholder:italic" />
                    <Button class="flex px-2 rounded-r" @click="searchUser()">
                        <font-awesome-icon icon="fas fa-magnifying-glass" class="self-center"></font-awesome-icon>
                    </Button>
                </div>

                <Alert type="success" :message="$page.props?.flash?.message" />

                <div class="relative overflow-x-auto shadow">
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
                            <tr v-for="(user, index) in props.users.data" :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300">
                                <td class="w-16 h-16 text-gray-900 align-top border border-slate-500">
                                    <ImgOrRandColor class="flex justify-center" :payload="user.details.avatar">
                                        <span class="self-center font-bold text-white">{{
                                                tap(user.name, name => name.match(/\b(\w)/g).join(``).substring(0
                                                    , 2).toUpperCase()/**/)
                                        }}</span>
                                    </ImgOrRandColor>
                                </td>
                                <td class="px-4 py-4 text-gray-900 align-top border border-slate-500 whitespace-nowrap">
                                    <div>{{ user.name }}
                                        <small v-if="$page.props.auth.user.id == user.id"
                                            class="px-2 py-1 mx-1 text-xs text-white uppercase bg-indigo-900 rounded-lg ">
                                            YOUR ACCOUNT
                                        </small>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-900 align-top border border-slate-500">
                                    {{ user.email }}
                                </td>
                                <td class="px-4 py-4 align-top border border-slate-500 whitespace-nowrap">
                                    {{ user.details.phone_number }}
                                </td>
                                <td class="px-4 py-4 font-medium text-gray-900 align-top border border-slate-500">
                                    <p v-show="showUserAddress" class="break-words">
                                        {{ user.details.address }}</p>
                                </td>
                                <td class="px-4 py-4 align-top border border-slate-500 whitespace-nowrap">
                                    {{ user.roles[0]['name'] }}
                                </td>
                                <td
                                    class=" py-4 px-2 border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap align-top">
                                    <div v-if="$page.props.auth.user.id == user.id">
                                        <ButtonLink :href="route(`auth.password.edit`)"
                                            class="px-2 py-1 space-x-1 text-white transition duration-300 rounded">
                                            <font-awesome-icon icon="fas fa-gear"></font-awesome-icon>
                                            <span class="hidden lg:inline-block">ACCOUNT SETTINGS</span>
                                        </ButtonLink>
                                    </div>
                                    <div v-else class="space-x-1">
                                        <ButtonLink :href="route(`users.edit`, user.id)"
                                            class="px-2 py-1 space-x-1 text-white transition duration-300 bg-blue-600 rounded hover:bg-blue-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-600/25 focus:bg-blue-600/90">
                                            <font-awesome-icon icon="fas fa-pencil"></font-awesome-icon>
                                            <span class="hidden lg:inline-block">EDIT</span>
                                        </ButtonLink>
                                        <Button @click="deleteUser(user)"
                                            class="px-2 py-1 space-x-1 text-white transition duration-300 bg-red-600 rounded hover:bg-red-600/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-600/25 focus:bg-red-600/90">
                                            <font-awesome-icon icon="fas fa-trash-can"></font-awesome-icon>
                                            <span class="hidden lg:inline-block">DELETE</span>
                                        </Button>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-row-reverse w-full">
                    <ButtonPagination class="basis-full lg:basis-3/12" :firstPageURL="props.users.first_page_url"
                        :prevPageURL="props.users.prev_page_url" :nextPageURL="props.users.next_page_url"
                        :currentPage="props.users.current_page" />
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
import ButtonLink from "../../Components/ButtonLink.vue";
import ButtonPagination from "../../Components/ButtonPagination.vue";
import Input from "../../Components/Input.vue";
import ImgOrRandColor from "../../Components/ImgOrRandColor.vue";
import { Head } from '@inertiajs/inertia-vue3'
import { tap, } from "../../Helpers";
import { ref, defineProps, computed } from "vue";
import { Inertia } from '@inertiajs/inertia'
import { SwalTailwind } from "../../Mixins/Swal";

const searchUserKeyword = ref(
    tap(new URL(window.location.href), url => url.searchParams.get(`keyword`))
);


const showUserAddress = ref(false);

const props = defineProps({
    users: {
        required: true,
    },
})

function searchUser() {
    Inertia.get(route('users.index'), {
        "keyword": searchUserKeyword.value,
    });
}

function deleteUser(user) {
    SwalTailwind.fire({
        title: `Delete confirmation`,
        text: `Are you sure you want to delete user "${user.name}" ?`,
        allowEnterKey: false,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
    }).then(result => {
        if (result.isConfirmed) {
            Inertia.delete(route('users.destroy', user.id));
        }
    });
}
</script>