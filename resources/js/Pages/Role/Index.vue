<template>
    <Head>
        <title>Roles</title>
        <meta name="roles" content="list of roles" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon icon="fas fa-shield" />
                <h1 class="text-lg font-semibold">ROLES</h1>
            </template>

            <main class="py-2 space-y-1 md:space-y-2 lg:space-y-3">
                <div class="flex">
                    <ButtonLink
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `roles.create`
                            )
                        "
                        :href="route(`roles.create`)"
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
                                    `roles.create`
                                )
                        }"
                        @onInput="({ value }) => (searchRolesKeyword = value)"
                        :value="searchRolesKeyword"
                        @keyup.enter="searchRoles()"
                        @blur="searchRoles()"
                        placeholder="Search roles by name"
                        type="text"
                        class="placeholder:italic"
                    />
                    <Button class="flex px-2 rounded-r">
                        <font-awesome-icon
                            icon="fas fa-magnifying-glass"
                            class="self-center"
                        ></font-awesome-icon>
                    </Button>
                </div>

                <Alert type="success" :message="$page.props?.flash?.message" />

                <div class="relative overflow-x-auto shadow">
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
                                    Role Name
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 border border-gray-500"
                                >
                                    Permissions
                                </th>
                                <th
                                    v-if="
                                        $page.props?.auth?.user?.permissions?.includes(
                                            `roles.edit`
                                        ) ||
                                        $page.props?.auth?.user?.permissions?.includes(
                                            `roles.delete`
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
                                v-for="(role, index) in props.roles.data"
                                :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300"
                            >
                                <td
                                    class="px-4 py-4 text-gray-900 align-top border lg:w-64 border-slate-500 whitespace-nowrap"
                                >
                                    <span
                                        class="text-base font-semibold text-slate-700"
                                        >{{ role.name }}</span
                                    >
                                </td>
                                <td
                                    class="p-2 space-x-2 text-gray-900 border border-slate-500 words-wrap"
                                >
                                    <ul
                                        class="space-x-1 space-y-1 overflow-y-auto max-h-64 lg:max-h-full scrollbar-hide"
                                    >
                                        <li
                                            v-for="(
                                                permission, index
                                            ) in role.permissions"
                                            :key="index"
                                            class="bg-indigo-700 text-white rounded py-0.5 md:px-1 px-0.5 font-semibold inline-block text-xs md:text-sm"
                                        >
                                            {{ permission }}
                                        </li>
                                        <li v-show="!role.permissions.length">
                                            <span
                                                class="text-base font-semibold text-slate-700"
                                                >No Permissions</span
                                            >
                                        </li>
                                    </ul>
                                </td>
                                <td
                                    v-if="
                                        $page.props?.auth?.user?.permissions?.includes(
                                            `roles.edit`
                                        ) ||
                                        $page.props?.auth?.user?.permissions?.includes(
                                            `roles.delete`
                                        )
                                    "
                                    class="py-4 px-2 space-x-1 border lg:space-x-1.5 border-slate-500 text-center whitespace-nowrap align-top w-16"
                                >
                                    <Link
                                        v-if="
                                            $page.props?.auth?.user?.permissions?.includes(
                                                `roles.edit`
                                            )
                                        "
                                        :href="route(`roles.edit`, role.id)"
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
                                                `roles.delete`
                                            )
                                        "
                                        @onClick="deleteRole(role)"
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

                <div class="flex flex-row-reverse w-full">
                    <ButtonPagination
                        class="basis-full lg:basis-3/12"
                        :currentPage="props.roles.current_page"
                    />
                </div>
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from '../../Layouts/AuthLayout.vue';
import Alert from '../../Components/Alert.vue';
import Card from '../../Components/Card.vue';
import Button from '../../Components/Button.vue';
import ButtonPagination from '../../Components/ButtonPagination.vue';
import ButtonLink from '../../Components/ButtonLink.vue';
import Input from '../../Components/Input.vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import { defineProps, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { tap } from '../../Helpers';
import { SwalTailwind } from '../../Mixins/Swal';

const props = defineProps(['roles']);

const searchRolesKeyword = ref(
    tap(new URL(window.location.href), (url) => url.searchParams.get(`keyword`))
);

function searchRoles() {
    Inertia.get(route(`roles.index`), {
        keyword: searchRolesKeyword.value
    });
}

function deleteRole(role) {
    SwalTailwind.fire({
        title: `Delete confirmation`,
        text: `Are you sure you want to delete role "${role.name}" ?`,
        allowEnterKey: false,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.delete(route('roles.destroy', role.id));
        }
    });
}
</script>
