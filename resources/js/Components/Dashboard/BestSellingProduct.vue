<template>
    <Card colorAccent="bg-violet-500">
        <template v-slot:title>
            <font-awesome-icon icon="fas fa-chart-pie"></font-awesome-icon>
            <h1 class="font-semibold">BEST SELLING PRODUCTS</h1>
        </template>

        <Doughnut
            :chart-options="chart.options"
            :chart-data="chart.data"
            chart-id="best-sell-products-chart"
            dataset-id-key="best-sell-products-chart-key"
            css-classes="overflow-x-auto"
        ></Doughnut>
    </Card>
</template>

<script setup>
import Card from '../Card.vue';
import { reactive, defineProps } from 'vue';
import { randInt, tap } from '../../Helpers';
import { Doughnut } from 'vue-chartjs';

const props = defineProps(['stats']);

const chart = reactive({
    type: 'doughnut',
    data: {
        labels: props.stats.map(
            (stat) =>
                `${stat.product_name} / ${stat.product_barcode.toUpperCase()}`
        ),
        datasets: [
            {
                data: props.stats.map((stat) => stat.value),
                backgroundColor: props.stats.map(() => `#${randColor()}`),
                hoverOffset: 4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        }
    }
});

function randColor() {
    console.log(props.stats);
    return Math.floor(Math.random() * 16777215).toString(16);
}
</script>
