<template>

    <Head>
        <title>Add New Customer</title>
        <meta name="Add New Customer" content="add a new customer" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class=" fas fa-bag-shopping" />
                <h1 class="text-lg font-semibold">ADD NEW CUSTOMER</h1>
            </template>

            <main class="grid grid-cols-1 gap-4 lg:grid-cols-2">

                <Input placeholder="Fullname" class="rounded placeholder:text-slate-700 lg:col-span-1 " />

                <Input placeholder="Phone Number (62XXXXxxxxXXXX)"
                    class="rounded placeholder:text-slate-700 lg:col-span-1 " />

                <Textarea placeholder="Address" class="rounded placeholder:text-slate-700 lg:col-span-2 " />

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