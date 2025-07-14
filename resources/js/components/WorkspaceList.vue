<script setup lang="ts">
import { defineProps } from 'vue';

defineProps({
    workspaces: Array, // Array of workspace objects passed as props
});
</script>

<template>
    <div class="space-y-4">
        <h1 class="text-2xl font-bold">Workspaces</h1>
        <div v-if="workspaces.length === 0" class="text-gray-500">
            No workspaces available.
        </div>
        <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div
                v-for="workspace in workspaces"
                :key="workspace.id"
                class="p-4 bg-white shadow rounded-lg"
            >
                <h2 class="text-lg font-bold">{{ workspace.name }}</h2>
                <p class="text-gray-600">{{ workspace.description }}</p>
                <p class="text-sm text-gray-500">Owner: {{ workspace.owner.name }}</p>
            </div>
        </div>
    </div>
</template>