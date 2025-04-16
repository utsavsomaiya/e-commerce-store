<template>
    <AuthenticatedLayout>
        <Head title="Categories" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <pre>{{ JSON.stringify(props.categories, null, 2) }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
    categories: {
        type: Object,
        required: true
    }
});
</script>
