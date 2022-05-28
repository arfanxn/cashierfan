<template>
    <Card colorAccent="bg-green-500">
        <template v-slot:title>
            <font-awesome-icon icon="fas fa-chart-pie"></font-awesome-icon>
            <h1 class="font-semibold">BEST SELLING PRODUCTS</h1>
        </template>

        <Doughnut :chart-options="chart.options" :chart-data="chart.data" chart-id="best-sell-products-chart"
            dataset-id-key="best-sell-products-chart-key" css-classes="overflow-x-auto"></Doughnut>

    </Card>
</template>

<script>
import Card from "../Card.vue"
import { reactive } from "vue";
import { randInt } from "../../Helpers";
import { Doughnut } from 'vue-chartjs'

export default {
    components: { Card, Doughnut },

    setup() {
        const chart = reactive({
            type: 'doughnut',
            data: {
                labels: ['Mie Ayam Bawang', 'Mie Rendang', 'Mie Bakso', 'Mie Iga Sapi'],
                datasets: [{
                    data: [randInt(1000, 10000), randInt(1000, 10000), randInt(1000, 10000), randInt(1000, 10000),],
                    backgroundColor: [
                        "rgb(239 ,68, 68)",
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: "top",
                    }
                }
            }
        })

        return { chart };
    }
}
</script>