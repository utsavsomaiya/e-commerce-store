<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <span class="p-6 text-gray-900">Category Distribution</span>
                    <div class="size-100 p-5">
                        <Pie :data="chartData" :options="chartOptions" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

import { Pie } from 'vue-chartjs'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement
} from 'chart.js'

const props = defineProps({
    categoryDistributions: {
        type: Object,
        required: true,
    }
})

ChartJS.register(Title, Tooltip, Legend, ArcElement)

const generateColors = (count) => {
  return Array.from({ length: count }, () => {
    const hue = Math.floor(Math.random() * 360)
    return `hsl(${hue}, 70%, 75%)`
  })
}

const labels = props.categoryDistributions.map(item => item.category)
const dataCounts = props.categoryDistributions.map(item => item.count)
const backgroundColors = generateColors(labels.length)

const chartData = {
    labels,
    datasets: [
        {
            label: 'Products',
            data: dataCounts,
            backgroundColor: backgroundColors,
            hoverOffset: 8
        }
    ],
}

const chartOptions = {
    responsive: true,
    plugins: {
        legend: {
            position: 'bottom'
        }
    }
}
</script>
