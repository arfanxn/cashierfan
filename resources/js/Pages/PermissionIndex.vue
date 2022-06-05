<template>

    <Head>
        <title>Permissions</title>
        <meta name="Permissions" content="list of Permissions" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon icon="fas fa-shield" />
                <h1 class="text-lg font-semibold">Permissions</h1>
            </template>

            <main class="py-2">
                <div class="flex">
                    <Input @onInput="({ value }) => (searchPermissionKeyword = value)" :value="searchPermissionKeyword"
                        @keyup.enter="searchPermissions()" @blur="searchPermissions()"
                        placeholder="Search or filter permissions by name" type="text"
                        class="rounded-l placeholder:italic" />
                    <Button class="flex px-2 rounded-r">
                        <font-awesome-icon icon="fas fa-magnifying-glass" class="self-center"></font-awesome-icon>
                    </Button>
                </div>



                <div class="relative mt-4 overflow-x-auto shadow">
                    <table class="w-full text-sm text-left text-black border border-collapse border-gray-500">
                        <thead class="text-xs text-white uppercase bg-indigo-900">
                            <tr>
                                <th scope="col" class="px-4 py-3 border border-gray-500">
                                    Permission Name
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(permission, index) in props.permissions" :key="index"
                                class="border-b even:bg-gray-100 odd:bg-white hover:bg-slate-300">
                                <td class="px-4 py-4 text-gray-900 border border-slate-500 whitespace-nowrap">
                                    <span class="font-semibold text-slate-700 text-lg">{{ permission }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- <div class="flex flex-row-reverse w-full mt-4">
                    <ButtonPagination class="basis-full lg:basis-3/12" :currentPage="1" />
                </div> -->
            </main>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "../Layouts/AuthLayout.vue";
import Card from "../Components/Card.vue";
import Button from "../Components/Button.vue";
import ButtonLink from "../Components/ButtonLink.vue";
import ButtonPagination from "../Components/ButtonPagination.vue";
import Input from "../Components/Input.vue";
import { Link, Head } from '@inertiajs/inertia-vue3'
import { defineProps, ref } from "vue";
import { tap } from "../Helpers";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps(['permissions']);

const searchPermissionKeyword = ref(
    tap(new URL(window.location.href), url => url.searchParams.get(`keyword`))
);

function searchPermissions() {
    Inertia.get(route('permissions.index'), {
        "keyword": searchPermissionKeyword.value,
    });
}

</script>