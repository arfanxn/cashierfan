<template>

    <Head title="Forgot Password"></Head>

    <GuestLayout>
        <main class="flex flex-col items-center w-full space-y-4 ">

            <div class="text-indigo-900 ">
                <font-awesome-icon icon="fas fa-shop" class="text-5xl lg:text-8xl" />
                <h1 class="text-xl font-bold lg:text-2xl">Cashierfan</h1>
            </div>
            <Card class="w-full lg:w-4/12">
                <form @submit.prevent="form.patch(route(`users.forgot-password`))" class="py-2 space-y-4 ">
                    <div class="text-slate-700">
                        <h1 class="text-xl font-normal uppercase">Forgot Password</h1>
                    </div>
                    <hr class="border border-1">

                    <div class="flex items-center bg-gray-200 rounded">
                        <font-awesome-icon icon="fas fa-envelope " class="px-2 "></font-awesome-icon>
                        <Input @onInput="({ value }) => (form.email = value)" class="rounded-r"
                            placeholder="Email Address" />
                    </div>
                    <Alert @onClose="form.errors.email = null" :message="form.errors?.email" />


                    <div class="flex items-center bg-gray-200 rounded">
                        <font-awesome-icon icon="fas fa-key " class="px-2 "></font-awesome-icon>
                        <Input @onInput="({ value }) => (form.verification_code = value)" class=""
                            placeholder="Verification Code" />
                        <Button @click="sendCode()" class="px-2 py-1 rounded-r">SEND</Button>
                    </div>
                    <Alert @onClose="form.errors.verification_code = null" :message="form.errors?.verification_code" />
                    <Alert v-if="!form.errors.verification_code" @onClose="alert.verification_code.message = null"
                        :type="alert.verification_code.type" :message="alert.verification_code.message" />


                    <div class="flex items-center bg-gray-200 rounded">
                        <Input @onInput="({ value }) => (form.password = value)" type="password" class="rounded"
                            placeholder="New Password" />
                    </div>
                    <div class="flex items-center bg-gray-200 rounded">
                        <Input @onInput="({ value }) => (form.confirm_password = value)" type="password" class="rounded"
                            placeholder="Confirm New Password" />
                    </div>
                    <Alert @onClose="tap(() => {
                        form.errors.password = null
                        form.errors.confirm_password = null
                    })" :message="form.errors?.password || form.errors?.confirm_password" />


                    <div class="flex justify-end">
                        <Link :href="route('users.login-page')" class="text-blue-500 underline ">Back to Login
                        </Link>
                    </div>

                    <Button type="submit"
                        class="w-full  py-1 lg:py-1.5 text-center rounded uppercase ">CONTINUE</Button>
                </form>
            </Card>
        </main>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "../../Layouts/GuestLayout.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Input from "../../Components/Input.vue";
import { isset, tap } from "../../Helpers";
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";
import { sendVerificationCode } from "../../Services/AuthService"
import { reactive } from "vue";
import Alert from "../../Components/Alert.vue";
const form = useForm({
    email: ``, verification_code: ``, password: ``, confirm_password: ``
});

const alert = reactive({
    verification_code: {
        type: "", message: "",
    }
})

async function sendCode() {
    sendVerificationCode({
        email: form.email
    }).then(({ response, json }) => {
        if (response.status == 429) { // if rate limit is reached
            const retryAfter = response.headers.get("retry-after");

            alert.verification_code.type = "errors";
            alert.verification_code.message = `${json.message} Resend again after ${retryAfter} seconds.`;
            return;
        }

        if (response.ok && json.message) {
            alert.verification_code.message = json.message;
            alert.verification_code.type = "success";
            return;
        } else if (json.errors) {
            form.setError({
                email: isset(() => json.errors.email[0]),
            });
        }
    });
}
</script>