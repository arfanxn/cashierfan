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
                    <h1 class="text-lg font-semibold">ACCOUNT SETTING (Email)</h1>
                </template>

                <form @submit.prevent="form.patch(route(`auth.email.update`))"
                    class="grid items-start grid-cols-1 gap-4 ">

                    <div class="grid items-start grid-cols-1 gap-4 lg:grid-cols-2 col-span-full ">
                        <div class="flex flex-col space-y-1">
                            <label class="text-slate-700" for="inpEmail">New Email Address</label>
                            <Input :value="form.email" id="inpEmail" type="text" placeholder="example@example.com"
                                class="rounded placeholder:text-slate-700"
                                @onInput="({ value }) => (form.email = value)" />
                            <Alert :message="form.errors.email" />
                            <Alert type="success" :message="$page.props.flash.message" />
                        </div>

                        <div class="space-y-1">
                            <label class="text-slate-700" for="inpVC">Verification Code</label>
                            <div class="flex items-start">
                                <Input id="inpVC" type="text" placeholder="112233"
                                    class="rounded placeholder:text-slate-700"
                                    @onInput="({ value }) => (form.verification_code = value)" />
                                <Button type="button" @click="sendCode()"
                                    class="px-2 py-1 uppercase rounded-r ">SEND&nbsp;CODE
                                </Button>
                            </div>
                            <Alert @onClose="form.errors.verification_code = null"
                                :message="form.errors.verification_code" />
                            <Alert @onClose="alert.verification_code.message = null"
                                v-if="!form.errors.verification_code" :type="alert.verification_code.type"
                                :message="alert.verification_code.message" />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <ButtonLink :href="route('auth.password.edit')"
                            class="px-2 py-1 text-white bg-blue-600 rounded focus:bg-blue-600/90 hover:bg-blue-600/90 focus:ring-4 focus:ring-blue-600/25">
                            PASSWORD SETTING</ButtonLink>
                    </div>

                    <div class="space-x-1">
                        <Button :disabled="form.processing" type="submit" class="px-2 py-1 rounded">SAVE</Button>
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
import Input from "../../Components/Input.vue";
import { isset } from "../../Helpers";
import { fetchAsJSON } from "../../Mixins/Fetch";
import { reactive, defineProps } from "vue";

const props = defineProps(['user']);

const form = useForm({
    email: props.user.email, verification_code: ``,
});

const alert = reactive({
    verification_code: {
        type: ``, message: ``
    },
})

function sendCode() {
    fetchAsJSON(route("auth.vc.send"), {
        body: { email: form.email }
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

    })
}

</script>