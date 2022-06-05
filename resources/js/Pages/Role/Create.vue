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

                <div class="lg:col-span-1 space-y-1">
                    <Input :value="form.name" @onInput="({ value }) => (form.name = value)" placeholder="Role Name"
                        class="rounded placeholder:text-slate-700  " />
                    <Alert @onClose="form.errors.name = null" :message="form.errors.name" />
                </div>

                <div class="grid grid-cols-1 lg:col-span-3 space-y-1">
                    <h2 class="block w-full text-lg font-semibold">Permissions</h2>
                    <ul class="grid grid-cols-12 overflow-y-auto max-h-52 md:max-h-96 lg:max-h-full">
                        <li class="flex items-center col-span-12 space-x-1 lg:col-span-4 md:col-span-6 "
                            v-for="(permission, i) in props.permissions" :key="i">
                            <input @change="selectPermission" :checked="form.permissions.includes(permission)"
                                :value="permission" type="checkbox" :id="permission" class="default:ring-4 " />
                            <label :for="permission">{{ permission }}</label>
                        </li>
                    </ul>

                    <Alert @onClose="form.errors.permissions = null" :message="form.errors.permissions" />
                </div>

            </main>

            <div class="my-4 space-x-1">
                <Button @onClick="form.post(route(`roles.store`))" class="px-2 py-1 rounded">SAVE</Button>
                <Button @onClick="form.reset()"
                    class="px-2 py-1 text-white bg-yellow-500 rounded focus:bg-yellow-500/90 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/25">CLEAR</Button>
            </div>
        </Card>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Alert from "../../Components/Alert.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Textarea from "../../Components/Textarea.vue";
import Input from "../../Components/Input.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps(['permissions']);

const form = useForm({
    name: ``, permissions: []
});

function selectPermission(event) {
    const permName = event.target.value.toString().toLowerCase();

    if (event.target.checked) {
        form.permissions.push(permName);
    } else {
        form.permissions = form.permissions.filter(permission =>
            permission.toString().toLowerCase() != permName);
    }
}

</script>