<template>

    <Head title="Verify" />


    <GuestLayout>
        <main class="w-full justify-center flex flex-col items-center space-y-4">
            <div class="text-indigo-900">
                <font-awesome-icon icon="fas fa-shop" class="text-5xl lg:text-8xl" />
                <h1 class="text-xl font-bold lg:text-2xl">Cashierfan</h1>
            </div>

            <Card class="w-full lg:w-4/12">
                <section class="py-2 space-y-4 ">
                    <div class="text-slate-700">
                        <h1 class="text-xl font-semibold text-slate-700 uppercase">Verify</h1>
                    </div>
                    <hr class="border border-1">

                    <div>
                        <div class="flex items-center bg-gray-200 rounded">
                            <font-awesome-icon icon="fas fa-envelope " class="px-2 "></font-awesome-icon>
                            <Input value="example@example.com" disabled class="rounded-r" placeholder="Email Address" />
                        </div>
                        <span></span>
                    </div>

                    <div>
                        <div class="flex items-center bg-gray-200 rounded">
                            <font-awesome-icon icon="fas fa-key " class="px-2 "></font-awesome-icon>
                            <Input class="rounded-r" placeholder="Verification Code" />
                        </div>
                        <Alert :message="$page.props.errors.verification_code" />
                    </div>

                    <div class="flex justify-between space-x-1">
                        <Button
                            class="w-full  py-1 lg:py-1.5 text-center rounded uppercase bg-yellow-500 hover:bg-yellow-500/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-yellow-500/25 focus:bg-yellow-500/90">RESEND
                            CODE</Button>
                        <Button @click="submit()"
                            class="w-full  py-1 lg:py-1.5 text-center rounded uppercase">CONTINUE</Button>
                    </div>
                </section>
            </Card>
        </main>
    </GuestLayout>

</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Alert from '../../Components/Alert.vue';
import Button from '../../Components/Button.vue';
import Card from '../../Components/Card.vue';
import Input from '../../Components/Input.vue';
import GuestLayout from '../../Layouts/GuestLayout.vue';

function submit() {
Inertia.p
}


</script>