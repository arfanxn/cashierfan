<template>

    <Head>
        <title>Edit User</title>
        <meta name="Edit User" content="Edit user" />
    </Head>

    <AuthLayout>
        <Card>
            <template v-slot:title>
                <font-awesome-icon class="fas fa-user" />
                <h1 class="text-lg font-semibold">EDIT USER</h1>
            </template>

            <main class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">

                <InputImage id="inpProdImg" class="border rounded lg:col-span-1 h-52">
                    <div
                        class="flex items-center justify-center h-full text-xl font-semibold bg-gray-100 text-slate-700">
                        <h1>UPDATE AVATAR</h1>
                    </div>
                </InputImage>


                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:col-span-3">
                    <Input id="inpFullname" placeholder="Fullname"
                        class="rounded placeholder:text-slate-700 lg:col-span-2 " />

                    <Input id="inpEmail" placeholder="Email"
                        class="rounded placeholder:text-slate-700 lg:col-span-1 " />

                    <Input id="inpPhoneNum" placeholder="Phone Number (62XXXXxxxxXXXX)"
                        class="rounded placeholder:text-slate-700 lg:col-span-1 " />

                    <Textarea id="inpAddress" placeholder="Address"
                        class="rounded placeholder:text-slate-700 lg:col-span-2 " />

                    <Input id="inpPassword" type="password" placeholder="Password"
                        class="rounded placeholder:text-slate-700 lg:col-span-1" />

                    <Input id="inpConfirmPassword" placeholder="Confirm Password" type="password"
                        class="rounded placeholder:text-slate-700 lg:col-span-1 " />
                </div>

                <div class="grid grid-cols-1 col-span-full ">
                    <h2 class="block w-full mb-1 text-lg font-semibold text-slatefully ">Roles</h2>
                    <ul class="grid grid-cols-12 overflow-y-auto max-h-52 md:max-h-96 lg:max-h-full">
                        <li class="flex items-center col-span-6 space-x-1 lg:col-span-2 md:col-span-4"
                            v-for="(item, i) in [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]"
                            :key="i">
                            <input type="checkbox" :id="`check${i}`" class="default:ring-4 " />
                            <label :for="`check${i}`">Member</label>
                        </li>
                    </ul>
                </div>

            </main>

            <div class="my-4 space-x-1">
                <Button class="px-2 py-1 rounded">UPDATE</Button>
                <Button
                    class="px-2 py-1 text-white bg-yellow-500 rounded focus:bg-yellow-500/90 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/25">CLEAR</Button>
            </div>
        </Card>
    </AuthLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Textarea from "../../Components/Textarea.vue";
import InputImage from "../../Components/InputImage.vue";
import Input from "../../Components/Input.vue";
import { randInt } from "../../Helpers";
import { ref } from "vue";

export default {
    components: { Card, Button, Input, InputImage, AuthLayout, Button, Textarea, Head },

    setup() {
        // const imgURL = ref("https://images.unsplash.com/photo-1635809847139-bb4e345cb317?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80");

        // setInterval(() => {
        //     imgURL.value = "https://images.unsplash.com/photo-1653668428146-5bab0dfc13e9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=600&q=60";
        // }, 3000)

        return {
            // imgURL , 
            Helpers: { randInt, },
        }
    }
}

</script>