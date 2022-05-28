<template>
    <Card>
        <template v-slot:title>
            <font-awesome-icon icon="fas fa-chart-column"></font-awesome-icon>
            <h1 class="font-semibold">SALES CHART 7 DAYS</h1>
        </template>

        <div class="">
            <Bar class="w-full" :chart-options="chart.options" :chart-data="chart.data" chart-id="sales-chart"
                dataset-id-key="sales-chart-key" css-classes="overflow-x-auto" />
        </div>

    </Card>
</template>

<script>
import { Bar } from 'vue-chartjs'
import Card from "../Card.vue";
import { reactive, } from "vue";
import { randInt } from "../../Helpers";



export default {
    components: { Card, Bar },

    setup() {
        const chart = reactive({
            type: 'bar',
            data: {
                labels: ['20-05-2022', '21-05-2022', '22-05-2022', '23-05-2022', '24-05-2022', '25-05-2022', `26-05-2022`],
                datasets: [{
                    label: 'Sales',
                    data: [randInt(5100000), randInt(5100000), randInt(5100000), randInt(5100000), randInt(5100000), randInt(5100000), randInt(5100000)],
                    backgroundColor: "rgba(239, 68, 68, 0.8)",
                    borderColor: "rgb(239, 68, 68)",
                    borderWidth: 1
                }, {
                    label: 'Profits',
                    data: [randInt(500000, 5000000), randInt(500000, 5000000), randInt(500000, 5000000), randInt(500000, 5000000), randInt(500000, 5000000), randInt(500000, 5000000), randInt(500000, 5000000)],
                    backgroundColor: "rgba(34 ,197, 94, 0.8)",
                    borderColor: "rgb(34, 197, 94)",
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
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
                        position: "top",
                    }
                }
            }
        });



        return { chart };
    }
}





</script>
