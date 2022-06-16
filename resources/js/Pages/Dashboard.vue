<template>
    <Head>
        <title>Dashboard</title>
        <meta name="Dashboard" content="Dashboard of point of sales" />
    </Head>

    <AuthLayout>
        <div class="grid items-start grid-cols-1 gap-4 lg:grid-cols-4">
            <SalesChart :stats="props.statistics.sales" class="lg:col-span-3" />

            <div class="grid grid-flow-row gap-4 auto-rows-max">
                <Card class="" colorAccent="bg-red-600">
                    <template v-slot:title>
                        <font-awesome-icon
                            icon="fas fa-chart-simple"
                        ></font-awesome-icon>
                        <h1 class="font-semibold">SALES TODAY</h1>
                    </template>

                    <div class="pb-4 space-y-2 font-semibold">
                        <p>
                            {{
                                parseInt(
                                    props.statistics.sale.total_happen_today
                                ) || 0
                            }}
                            <span class="font-light">SALES</span>
                        </p>
                        <hr />
                        <div class="flex space-x-1">
                            <span>
                                {{
                                    toCurrency(
                                        props.statistics.sale.grosses_today || 0
                                    ).output
                                }}
                            </span>
                            <small class="font-thin self-start">Grosses</small>
                        </div>
                        <hr />
                        <div class="flex space-x-1">
                            <span>
                                {{
                                    toCurrency(
                                        isset(
                                            () =>
                                                parseFloat(
                                                    props.statistics.sale
                                                        .grosses_today
                                                ) +
                                                parseFloat(
                                                    props.statistics.sale
                                                        .taxes_today
                                                ) +
                                                parseFloat(
                                                    props.statistics.sale
                                                        .profits_today
                                                ),
                                            0
                                        )
                                    ).output
                                }}
                            </span>
                            <small class="font-thin self-start">Netts</small>
                        </div>
                    </div>
                </Card>

                <Card class="" colorAccent="bg-green-500">
                    <template v-slot:title>
                        <font-awesome-icon
                            icon="fas fa-chart-line"
                        ></font-awesome-icon>
                        <h1 class="font-semibold">PROFITS TODAY</h1>
                    </template>

                    <div class="pb-4 space-y-2 font-semibold">
                        <p class="block">
                            {{
                                toCurrency(
                                    props.statistics.sale.profits_today || 0
                                ).output
                            }}
                        </p>
                    </div>
                </Card>

                <Card class="" colorAccent="bg-yellow-500">
                    <template v-slot:title>
                        <font-awesome-icon
                            icon="fas fa-money-bills"
                        ></font-awesome-icon>
                        <h1 class="font-semibold">TAXES TODAY</h1>
                    </template>

                    <div class="pb-4 space-y-2 font-semibold">
                        <p class="block">
                            {{
                                toCurrency(
                                    props.statistics.sale.taxes_today || 0
                                ).output
                            }}
                        </p>
                    </div>
                </Card>
            </div>

            <BestSellingProduct
                :stats="props.statistics.products.best_sellings"
                class="lg:col-span-2"
            />

            <ProductStocks :products="props.products" class="lg:col-span-2" />
        </div>
    </AuthLayout>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import BestSellingProduct from '../Components/Dashboard/BestSellingProduct.vue';
import ProductStocks from '../Components/Dashboard/ProductStock.vue';
import SalesChart from '../Components/Dashboard/SaleChart.vue';
import Button from '../Components/Button.vue';
import Input from '../Components/Input.vue';
import Card from '../Components/Card.vue';
import FontAwesomeIcon from '../Components/FontAwesomeIcon.vue';
import AuthLayout from '../Layouts/AuthLayout.vue';
import { tap, toCurrency, isset } from '../Helpers';
import { defineProps, onMounted } from 'vue';
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    ArcElement,
    CategoryScale,
    LinearScale,
    PluginOptionsByType
} from 'chart.js';
ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    ArcElement
);

const props = defineProps(['statistics', 'products']);
</script>
