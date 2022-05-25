<template>
    <AuthLayout>
        <main class="">
            <section class="flex space-x-8">
                <Card class="grow">
                    <template v-slot:title>
                        <font-awesome-icon icon="fas fa-chart-column"></font-awesome-icon>
                        <h1 class="font-semibold">SALES CHART 7 DAYS</h1>
                    </template>
                </Card>

                <div class="space-y-8 w-96">
                    <Card accentColor="bg-red-600">
                        <template v-slot:title>
                            <font-awesome-icon icon="fas fa-chart-simple"></font-awesome-icon>
                            <h1 class="font-semibold ">SALES TODAY</h1>
                        </template>

                        <div class="pb-4 space-y-2 font-semibold text-md ">
                            <p>0 <span class="font-light">SALES</span></p>
                            <hr>
                            <p class="block">Rp. 0</p>
                        </div>
                    </Card>

                    <Card accentColor="bg-yellow-500">
                        <template v-slot:title>
                            <font-awesome-icon icon="fas fa-chart-line"></font-awesome-icon>
                            <h1 class="font-semibold">PROFITS TODAY</h1>
                        </template>

                        <div class="pb-4 space-y-2 font-semibold text-md ">
                            <p class="block">Rp. 0</p>
                        </div>
                    </Card>
                </div>
            </section>

            <section class="flex mt-8 space-x-8">
                <Card accentColor="bg-green-500">
                    <template v-slot:title>
                        <font-awesome-icon icon="fas fa-chart-pie"></font-awesome-icon>
                        <h1 class="font-semibold">BEST SELLING PRODUCTS</h1>
                    </template>

                    <div class="">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt, modi perferendis.
                        Quibusdam, eum? Suscipit temporibus rerum veritatis, hic accusantium consequuntur itaque
                        dignissimos dicta molestias praesentium vitae nam, minus explicabo quod.</div>
                </Card>

                <Card accentColor="bg-blue-500">
                    <template v-slot:title>
                        <font-awesome-icon icon="fas fa-box-open"></font-awesome-icon>
                        <h1 class="font-semibold">PRODUCT STOCKS</h1>
                    </template>

                    <div class="">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt, modi perferendis.
                        Quibusdam, eum? Suscipit temporibus rerum veritatis, hic accusantium consequuntur itaque
                        dignissimos dicta molestias praesentium vitae nam, minus explicabo quod.</div>
                </Card>

            </section>
        </main>
    </AuthLayout>
</template>

<script>
import Button from "../Components/Button.vue";
import Card from "../Components/Card.vue";
import AuthLayout from "../Layouts/AuthLayout.vue";

export default {
    components: {
        "v-button": Button, AuthLayout, Card
    },

    setup() {
    }
}
</script>