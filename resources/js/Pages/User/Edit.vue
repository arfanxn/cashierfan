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

            <form @submit.prevent="form.post(route(`users.update`, props.user.id), {
                forceFormData: true,
            })" class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">

                <div class="flex flex-col space-y-1 lg:col-span-1">
                    <InputImage class="border rounded h-52" @onInput="({ file }) => (form.avatar = file)"
                        :previewImgURL="form.avatar" id="inpUserImg"
                        @onError="({ message }) => (form.errors.avatar = message)">
                        <div
                            class="flex items-center justify-center h-full text-xl font-semibold bg-gray-100 text-slate-700">
                            <h1>UPDATE AVATAR</h1>
                        </div>
                    </InputImage>
                    <Alert :message="form.errors.avatar" />
                </div>


                <div class="grid items-start grid-cols-1 gap-4 lg:grid-cols-2 lg:col-span-3">
                    <div class="flex flex-col space-y-1 lg:col-span-2">
                        <Input :value="props.user.name" id="inpFullname" placeholder="Fullname"
                            class="rounded placeholder:text-slate-700 " @onInput="({ value }) => (form.name = value)" />
                        <Alert :message="form.errors.name" />
                    </div>


                    <div class="flex flex-col space-y-1 lg:col-span-1">
                        <Input :value="props.user.email" id="inpEmail" placeholder="Email"
                            @onInput="({ value }) => (form.email = value)"
                            class="rounded placeholder:text-slate-700 " />
                        <Alert :message="form.errors.email" />
                    </div>

                    <div class="flex flex-col space-y-1 lg:col-span-1">
                        <Input :value="props.user.details.phone_number" id="inpPhoneNum"
                            placeholder="Phone Number (62XXXXxxxxXXXX)" class="rounded placeholder:text-slate-700 "
                            @onInput="({ value }) => (form.phone_number = value)" />
                        <Alert :message="form.errors.phone_number" />
                    </div>

                    <div class="flex flex-col space-y-1 lg:col-span-2">
                        <Textarea :value="props.user.details.address" id="inpAddress" placeholder="Address"
                            class="rounded placeholder:text-slate-700"
                            @onChange="({ value }) => (form.address = value)" />
                        <Alert :message="form.errors.address" />
                    </div>

                    <div class="flex flex-col space-y-1 lg:col-span-1">
                        <Input id="inpPassword" type="password" placeholder="Password"
                            class="rounded placeholder:text-slate-700"
                            @onInput="({ value }) => (form.password = value)" />
                        <Alert :message="form.errors.password" />
                    </div>

                    <div class="flex flex-col space-y-1 lg:col-span-1">
                        <Input id="inpConfirmPassword" placeholder="Confirm Password" type="password"
                            class="rounded placeholder:text-slate-700 lg:col-span-1 "
                            @onInput="({ value }) => (form.confirm_password = value)" />
                        <Alert :message="form.errors.password" />
                    </div>

                </div>

                <div class="grid grid-cols-1 col-span-full">
                    <div class="flex flex-col space-y-1 ">
                        <h2 class="text-lg font-semibold text-slate-700">Roles</h2>
                        <Alert :message="form.errors.role" />
                    </div>
                    <ul class="grid grid-cols-12 overflow-y-auto max-h-52 md:max-h-96 lg:max-h-full">
                        <li class="flex items-center col-span-6 space-x-1 lg:col-span-2 md:col-span-4"
                            v-for="(role, i) in props.roles" :key="i">
                            <input :value="role" type="checkbox" :checked="selectedRole === role" :id="`inpRole${role}`"
                                class="default:ring-4 " @change="selectRole" />
                            <label :for="`inpRole${role}`">{{ role }}</label>
                        </li>
                    </ul>
                </div>

                <div class="my-4 space-x-1 col-span-full">
                    <Button type="submit" class="px-2 py-1 rounded">UPDATE</Button>
                    <Button type="button"
                        class="px-2 py-1 text-white bg-yellow-500 rounded focus:bg-yellow-500/90 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/25">CLEAR</Button>
                </div>
            </form>


        </Card>
    </AuthLayout>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Alert from "../../Components/Alert.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Textarea from "../../Components/Textarea.vue";
import InputImage from "../../Components/InputImage.vue";
import Input from "../../Components/Input.vue";
import { randInt, tap } from "../../Helpers";
import { ref, defineProps, computed } from "vue";

const props = defineProps({
    user: {
        required: true, type: Object
    },
    roles: {
        required: true, type: Array
    }
});

const form = useForm({
    avatar: tap(props.user.details.avatar, avatar => avatar.length <= 7 ? null : avatar),
    name: props.user.name,
    email: props.user.email,
    phone_number: props.user.details.phone_number,
    address: props.user.details.address,
    password: props.user.details.password,
    confirm_password: props.user.details.confirm_password,
    role: props.user.role,
});


const selectedRole = computed(() => form.role);
function selectRole(event) {
    if (event.target.checked) {
        form.role = event.target.value;
    } else {
        form.role = ``;
    }
}
</script>