<script setup lang="ts">
import { useWorkspacesStore, type WorkspaceType } from '@/layouts/store/workspaces';
import { defineProps, onMounted, ref } from 'vue';

const props = defineProps<{
    workspace_id: string;
}>();

const workspace = ref(null as WorkspaceType | null);
const workspaceStore = useWorkspacesStore();

// Fetch data when the component is mounted
onMounted(async () => {
    workspace.value = await workspaceStore.fetchWorkspace(props.workspace_id);
});
</script>

<template>
    <div class="space-y-6 p-6">
        <div v-if="!workspace" class="text-gray-500">Loading workspace details...</div>
        <div v-else class="rounded-lg bg-white p-4 shadow">
            <h1 class="text-2xl font-bold">{{ workspace.name }}</h1>
            <p class="text-gray-600">{{ workspace.description }}</p>
            <p class="text-sm text-gray-500">Owner: {{ workspace.owner_id }}</p>
        </div>
    </div>
</template>
