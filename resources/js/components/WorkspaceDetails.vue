<script setup lang="ts">
import { defineProps } from 'vue';

defineProps({
    workspace: Object, // Workspace object passed as props
});
</script>

<template>
    <div class="p-6 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold">{{ workspace.name }}</h1>
        <p class="text-gray-600">{{ workspace.description }}</p>
        <p class="text-sm text-gray-500">Owner: {{ workspace.owner.name }}</p>
    </div>
</template>