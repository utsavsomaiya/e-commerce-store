<template>
    <span
        :class="[
            sizeClass,
            'font-extrabold text-gradient bg-gradient-to-r from-blue-400 via-green-500 to-yellow-500 bg-clip-text text-transparent'
        ]"
    >
        E-commerce Store
    </span>
</template>
<script setup>
defineProps({
    sizeClass: {
        type: String,
        default: '',
    }
})
</script>
