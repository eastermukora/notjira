<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Breadcrumb from '@/components/ui/breadcrumb/Breadcrumb.vue';
import CreateWorkspaceButton from '@/components/CreateWorkspaceButton.vue';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', url: '/dashboard' },
    { title: 'Workspaces', url: '/workspaces' },
    { title: 'Create Workspace', url: '/workspaces/create' }
];

const workspaces = ref([]); // Reactive variable to store workspaces

// Fetch workspaces from the backend
const fetchWorkspaces = async () => {
    try {
        const response = await axios.get('/dashboard'); // Adjust the endpoint if necessary
        workspaces.value = response.data.workspaces;
    } catch (error) {
        console.error('Error fetching workspaces:', error);
    }
};

// Fetch data when the component is mounted
onMounted(() => {
    fetchWorkspaces();
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Dashboard" />

        <div class="p-6 space-y-6">
            <!-- Workspaces Section -->
            <div class="space-y-4">
                <h1 class="text-2xl font-bold">Workspaces</h1>
                <CreateWorkspaceButton />
                <div v-if="workspaces.length === 0" class="text-gray-500">
                    No workspaces available.
                </div>
                <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        v-for="workspace in workspaces"
                        :key="workspace.id"
                        class="p-4 bg-white shadow rounded-lg"
                    >
                        <h2 class="text-lg font-bold">
                            <!-- Link to Workspace Details Page -->
                            <a
                                :href="`/workspaces/${workspace.id}`"
                                class="text-blue-500 hover:underline"
                            >
                                {{ workspace.name }}
                            </a>
                        </h2>
                        <p class="text-gray-600">{{ workspace.description }}</p>
                        <p class="text-sm text-gray-500">Owner: {{ workspace.owner.name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>