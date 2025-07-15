<script setup lang="ts">
import CreateTaskButton from '@/components/CreateTaskButton.vue';
import UpdateTaskButton from '@/components/UpdateTaskButton.vue';

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
        <CreateTaskButton :workspace_id="props.workspace_id" />
        <div v-if="!workspace" class="text-gray-500">Loading workspace details...</div>
        <div v-else>
            <!-- Workspace details -->
            <h1 class="text-2xl font-bold">{{ workspace.name }}</h1>
            <p class="text-gray-600">{{ workspace.description }}</p>
            <p class="text-sm text-gray-500">Owner: {{ workspace.owner_id }}</p>

            <hr />

            <!-- Tasks -->
            <h1 class="text-xl font-bold">Tasks</h1>
            <div v-if="workspace.tasks.length > 0" class="space-y-4">
                <div v-for="task in workspace.tasks" :key="task.id">
                    <h2 class="text-lg font-bold">
                        <!-- Link to Task Details Page -->
                        <a :href="`/workspaces/${workspace.id}/tasks/${task.id}`" class="text-blue-500 hover:underline">
                            {{ task.title }}
                        </a>
                    </h2>
                    <p class="text-gray-600">{{ task.description }}</p>
                    <p class="text-sm text-gray-500">Owner: {{ task.owner_id }}</p>
                    <UpdateTaskButton :task="task" />
                </div>
            </div>
        </div>
    </div>
</template>
