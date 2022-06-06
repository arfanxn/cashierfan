<template>

    <Head>
        <title>Edit Profile</title>
        <meta name="Edit Profile" content="Edit Profile" />
    </Head>

    <AuthLayout>
        <main class="">
            <Card>
                <template v-slot:title>
                    <font-awesome-icon class="fas fa-user" />
                    <h1 class="text-lg font-semibold">EDIT PROFILE</h1>
                </template>

                <form @submit.prevent="form.post(route(`auth.profile.update`), {
                    forceFormData: true,
                })" class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">

                    <div class="flex flex-col space-y-1 lg:col-span-1">
                        <InputImage class="border rounded h-52" @onInput="({ file }) => (form.avatar = file)"
                            :previewImgURL="form.avatar" id="inpUserImg"
                            @onError="({ message }) => (form.errors.avatar = message)">
                            <div
                                class="flex items-center justify-center h-full text-xl font-semibold bg-gray-100 text-slate-700">
                                <h1>ADD AVATAR</h1>
                            </div>
                        </InputImage>
                        <Alert @onClose="form.errors.avatar = null" :message="form.errors.avatar" />
                    </div>


                    <div class="grid items-start grid-cols-1 gap-4 lg:grid-cols-2 lg:col-span-3">
                        <div class="flex flex-col space-y-1 lg:col-span-1">
                            <Input :value="props.user.name" id="inpFullname" placeholder="Fullname"
                                class="rounded placeholder:text-slate-700 "
                                @onInput="({ value }) => (form.name = value)" />
                            <Alert @onClose="form.errors.name = null" :message="form.errors.name" />
                        </div>

                        <div class="flex flex-col space-y-1 lg:col-span-1">
                            <Input :value="props.user.details.phone_number" id="inpPhoneNum"
                                placeholder="Phone Number (62XXXXxxxxXXXX)" class="rounded placeholder:text-slate-700 "
                                @onInput="({ value }) => (form.phone_number = value)" />
                            <Alert @onClose="form.errors.phone_number = null" :message="form.errors.phone_number" />
                        </div>

                        <div class="flex flex-col space-y-1 lg:col-span-2">
                            <Textarea :value="props.user.details.address" id="inpAddress" placeholder="Address"
                                class="rounded placeholder:text-slate-700"
                                @onChange="({ value }) => (form.address = value)" />
                            <Alert @onClose="form.errors.address = null" :message="form.errors.address"
                                @onClose="form.errors.address = null" />
                            <Alert @onClose="$page.props.flash.message = null" type="success"
                                :message="$page.props.flash.message" />
                        </div>
                    </div>

                    <div class="my-4 space-x-1 col-span-full">
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
import { defineProps } from "vue";

const props = defineProps(["user"]);

const form = useForm({
    avatar: tap(props.user.details.avatar, avatar => avatar.length <= 7 ? null : avatar),
    name: props.user.name,
    phone_number: props.user.details.phone_number,
    address: props.user.details.address,
});



</script>