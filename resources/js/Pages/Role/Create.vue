<template>

    <Head>
        <title>Add Role</title>
        <meta name="Add Role" content="Add Role" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class=" fas fa-shield" />
                <h1 class="text-lg font-semibold">Add Role</h1>
            </template>

            <main class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">

                <Input placeholder="Role Name" class="rounded placeholder:text-slate-700 lg:col-span-1 " />

                <div class="grid grid-cols-1 lg:col-span-3">
                    <h2 class="block w-full mb-1 text-lg font-semibold">Permissions</h2>
                    <ul class="grid grid-cols-12 overflow-y-auto max-h-52 md:max-h-96 lg:max-h-full ">
                        <li class="flex items-center col-span-12 space-x-1 lg:col-span-4 md:col-span-6 "
                            v-for="(item, i) in [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]"
                            :key="i">
                            <input type="checkbox" :id="`check${i}`" class="default:ring-4 " />
                            <label :for="`check${i}`">users.index{{ i }}</label>
                        </li>
                    </ul>
                </div>

            </main>

            <div class="my-4 space-x-1">
                <Button class="px-2 py-1 rounded">SAVE</Button>
                <Button
                    class="px-2 py-1 text-white bg-yellow-500 rounded focus:bg-yellow-500/90 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/25">CLEAR</Button>
            </div>
        </Card>
    </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Textarea from "../../Components/Textarea.vue";
import Input from "../../Components/Input.vue";
import { randInt } from "../../Helpers";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: { Card, Button, Input, AuthLayout, Button, Textarea, Head },

    setup() {
        return {
            Helpers: { randInt }
        }
    }
}

</script>