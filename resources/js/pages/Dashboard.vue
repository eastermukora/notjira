<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref, defineProps, reactive } from 'vue';

defineProps({
    workspaces: Array, // Workspaces data passed from the controller
});

const createWorkspace = () => {
    console.log('Create Workspace button clicked');
    // Add logic for creating a new workspace (e.g., open a modal or redirect to a form)
};
</script>

<template>
    <Head title="Dashboard" />

    <div class="p-6 space-y-6">
        <!-- Workspaces Section -->
        <div class="space-y-4">
            <h1 class="text-2xl font-bold">Workspaces</h1>
            <div v-if="workspaces.length === 0" class="text-gray-500">
                No workspaces available. Click the button below to create one.
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
        
        <div class="flex justify-center mt-6">
            <button
                @click="createWorkspace"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
            >
                Create Workspace
            </button>
        </div>
    </div>
</template>