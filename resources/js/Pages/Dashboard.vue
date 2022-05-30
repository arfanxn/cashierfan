<template>

    <Head>
        <title>Dashboard</title>
        <meta name="Dashboard" content="Dashboard of point of sales" />
    </Head>

    <AuthLayout>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">
            <SalesChart class="lg:col-span-3" />

            <div class="grid grid-flow-row gap-4 auto-rows-max">
                <Card class="" colorAccent="bg-red-600">
                    <template v-slot:title>
                        <font-awesome-icon icon="fas fa-chart-simple"></font-awesome-icon>
                        <h1 class="font-semibold ">SALES TODAY</h1>
                    </template>

                    <div class="pb-4 space-y-2 font-semibold">
                        <p>0 <span class="font-light">SALES</span></p>
                        <hr>
                        <p class="block">Rp. 0</p>
                    </div>
                </Card>

                <Card class="" colorAccent="bg-yellow-500">
                    <template v-slot:title>
                        <font-awesome-icon icon="fas fa-chart-line"></font-awesome-icon>
                        <h1 class="font-semibold">PROFITS TODAY</h1>
                    </template>

                    <div class="pb-4 space-y-2 font-semibold">
                        <p class="block">Rp. 0</p>
                    </div>
                </Card>
            </div>

            <BestSellingProducts class="lg:col-span-2" />

            <ProductStocks class="lg:col-span-2" />
        </div>
    </AuthLayout>



</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import BestSellingProducts from "../Components/Dashboard/BestSellingProducts.vue"
import ProductStocks from "../Components/Dashboard/ProductStocks.vue"
import SalesChart from "../Components/Dashboard/SalesChart.vue"
import Button from "../Components/Button.vue";
import Input from "../Components/Input.vue";
import Card from "../Components/Card.vue";
import FontAwesomeIcon from '../Components/FontAwesomeIcon.vue';
import AuthLayout from "../Layouts/AuthLayout.vue";

import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, ArcElement, CategoryScale, LinearScale, PluginOptionsByType } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement)

export default {
    components: {
        "v-button": Button,
        AuthLayout,
        Card,
        FontAwesomeIcon,
        Input,
        ProductStocks,
        SalesChart,
        BestSellingProducts,
        Head
    },

    setup() {
    }
}
</script>