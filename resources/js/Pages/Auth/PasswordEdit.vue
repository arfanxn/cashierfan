<template>

    <Head>
        <title>Account Setting</title>
        <meta name="Account Setting" content="Account Setting" />
    </Head>


    <AuthLayout>
        <main class="">
            <Card>
                <template v-slot:title>
                    <font-awesome-icon class="fas fa-user" />
                    <h1 class="text-lg font-semibold">ACCOUNT SETTING (Password)</h1>
                </template>

                <form autocomplete="off" @submit.prevent="form.patch(route(`auth.password.update`))"
                    class="grid items-start grid-cols-1 col-span-4 gap-4 lg:grid-cols-4">

                    <div class="space-y-1 col-span-full">
                        <label class="text-slate-700" for="inpCurrentPassword">Current Password</label>
                        <Input autocomplete="off" id="inpCurrentPassword" type="password"
                            placeholder="Your current password" class="rounded placeholder:text-slate-700"
                            @onInput="({ value }) => (form.current_password = value)" />
                        <Alert @onClose="form.errors.current_password = null" :message="form.errors.current_password" />
                        <Alert v-if="!form.errors.current_password" type="success"
                            :message="$page.props.flash.message" />
                    </div>

                    <div class="grid items-start grid-cols-1 gap-4 col-span-full lg:grid-cols-2 ">
                        <div class="flex flex-col space-y-1">
                            <label class="text-slate-700" for="inpPassword">New Password</label>
                            <Input id="inpPassword" type="password" placeholder="********"
                                class="rounded placeholder:text-slate-700"
                                @onInput="({ value }) => (form.password = value)" />
                            <Alert @onClose="form.errors.password = null" :message="form.errors.password" />
                        </div>

                        <div class="flex flex-col space-y-1">
                            <label class="text-slate-700" for="inpConfirmPassword">Confirm New Password</label>
                            <Input id="inpConfirmPassword" placeholder="********" type="password"
                                class="rounded placeholder:text-slate-700"
                                @onInput="({ value }) => (form.confirm_password = value)" />
                            <Alert @onClose="form.errors.confirm_password = null"
                                :message="form.errors.confirm_password" />
                        </div>
                    </div>

                    <div class="flex justify-end col-span-full">
                        <ButtonLink :href="route('auth.email.edit')"
                            class="px-2 py-1 text-white bg-blue-600 rounded focus:bg-blue-600/90 hover:bg-blue-600/90 focus:ring-4 focus:ring-blue-600/25">
                            EMAIL SETTING</ButtonLink>
                    </div>


                    <div class="space-x-1 col-span-full">
                        <Button type="submit" class="px-2 py-1 rounded">SAVE</Button>
                        <ButtonLink :href="route('/')"
                            class="px-2 py-1 text-white bg-yellow-500 rounded focus:bg-yellow-500/90 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/25">
                            CANCEL</ButtonLink>
                    </div>
                </form>

            </Card>
        </main>
    </AuthLayout>
</template>

<script setup>
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Alert from "../../Components/Alert.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import ButtonLink from "../../Components/ButtonLink.vue";
import Textarea from "../../Components/Textarea.vue";
import InputImage from "../../Components/InputImage.vue";
import Input from "../../Components/Input.vue";
import { tap } from "../../Helpers";
import { defineProps, watch } from "vue";

const form = useForm({
    current_password: ``, password: ``, confirm_password: ``,
});




</script>