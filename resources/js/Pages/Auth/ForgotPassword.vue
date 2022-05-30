<template>

    <Head title="Forgot Password"></Head>

    <GuestLayout>
        <main class="flex flex-col items-center justify-center h-screen space-y-6">

            <div class="text-center text-indigo-900">
                <font-awesome-icon icon="fas fa-shop" class="text-5xl lg:text-8xl" />
                <h1 class="text-xl font-bold lg:text-2xl">Arf-Market</h1>
            </div>
            <Card class="w-full lg:w-4/12">
                <section class="py-2 space-y-4 ">
                    <div class="text-slate-700">
                        <h1 class="text-xl font-normal uppercase">Forgot Password</h1>
                    </div>
                    <hr class="border border-1">
                    <div class="flex items-center bg-gray-200 rounded">
                        <font-awesome-icon icon="fas fa-envelope " class="px-2 "></font-awesome-icon>
                        <Input class="rounded-r" placeholder="Email Address" />
                    </div>

                    <div class="flex justify-end">
                        <Link :href="route('users.login')" class="text-blue-500 underline ">Back to Login
                        </Link>
                    </div>

                    <Button class="w-full  py-1 lg:py-1.5 text-center rounded uppercase ">SEND PASSWORD RESET
                        LINK</Button>
                </section>
            </Card>
        </main>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "../../Layouts/GuestLayout.vue";
import Card from "../../Components/Card.vue";
import Button from "../../Components/Button.vue";
import Input from "../../Components/Input.vue";
import { Link } from "@inertiajs/inertia-vue3";





</script>