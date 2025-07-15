<script setup lang="ts">
import CreateWorkspaceButton from '@/components/CreateWorkspaceButton.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useWorkspacesStore } from '@/layouts/store/workspaces';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', url: '/dashboard' },
    { title: 'Workspaces', url: '/workspaces' },
    { title: 'Create Workspace', url: '/workspaces/create' },
];

const workspacesStore = useWorkspacesStore();

// Fetch data when the component is mounted
onMounted(() => {
    workspacesStore.fetchWorkspaces();
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Dashboard" />

        <div class="space-y-6 p-6">
            <!-- Workspaces Section -->
            <div class="space-y-4">
                <div class="flex w-full items-center justify-between">
                    <h1 class="text-2xl font-bold">Workspaces</h1>
                    <CreateWorkspaceButton />
                </div>

                <div v-if="workspacesStore.workspaces.length === 0" class="text-gray-500">No workspaces available.</div>

                <div v-else class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div v-for="workspace in workspacesStore.workspaces" :key="workspace.id" class="rounded-lg bg-white p-4 shadow">
                        <h2 class="text-lg font-bold">
                            <!-- Link to Workspace Details Page -->
                            <a :href="`/workspaces/${workspace.id}`" class="text-blue-500 hover:underline">
                                {{ workspace.name }}
                            </a>
                        </h2>
                        <p class="text-gray-600">{{ workspace.description }}</p>
                        <p class="text-sm text-gray-500">Owner: {{ workspace.owner_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
