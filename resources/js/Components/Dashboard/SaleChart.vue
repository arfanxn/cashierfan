<template>
    <Card>
        <template v-slot:title>
            <font-awesome-icon icon="fas fa-chart-column"></font-awesome-icon>
            <h1 class="font-semibold">SALES CHART 7 DAYS</h1>
        </template>

        <div class="">
            <Bar
                class="w-full"
                :chart-options="chart.options"
                :chart-data="chart.data"
                chart-id="sales-chart"
                dataset-id-key="sales-chart-key"
                css-classes="overflow-x-auto"
            />
        </div>
    </Card>
</template>

<script setup>
import { Bar } from 'vue-chartjs';
import Card from '../Card.vue';
import { reactive, defineProps, onMounted, ref } from 'vue';
import { tap, randInt } from '../../Helpers';

const props = defineProps(['stats']);

const stat_dates = ref(Object.keys(props.stats));

const chart = reactive({
    type: 'bar',
    data: {
        labels: stat_dates.value,
        datasets: [
            {
                label: 'Grosses',
                data: stat_dates.value.map(
                    (date) => props.stats[date]['sales_grosses']['value']
                ),
                backgroundColor: 'rgba(239, 68, 68, 0.8)',
                borderColor: 'rgb(239, 68, 68)',
                borderWidth: 1
            },
            {
                label: 'Profits',
                data: stat_dates.value.map(
                    (date) => props.stats[date]['sales_profits']['value']
                ),
                backgroundColor: 'rgba(34 ,197, 94, 0.8)',
                borderColor: 'rgb(34, 197, 94)',
                borderWidth: 1
            },
            {
                label: 'Taxes',
                data: stat_dates.value.map(
                    (date) => props.stats[date]['sales_taxes']['value']
                ),
                backgroundColor: 'rgba(234, 179, 8, 0.8)',
                borderColor: 'rgb(234, 179, 8)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        }
    }
});
</script>
