<script setup lang="ts">
import AssignUserButton from '@/components/AssignUserButton.vue';
import CreateTaskButton from '@/components/CreateTaskButton.vue';
import InviteUserButton from '@/components/InviteUserButton.vue';
import UpdateTaskButton from '@/components/UpdateTaskButton.vue';

import { useWorkspacesStore } from '@/layouts/store/workspaces';
import { defineProps, onMounted } from 'vue';

const props = defineProps<{
    workspace_id: string;
}>();

const workspaceStore = useWorkspacesStore();

// Fetch data when the component is mounted
onMounted(async () => {
    await workspaceStore.fetchWorkspace(props.workspace_id);
});
</script>

<template>
    <div class="space-y-6 p-6">
        <div class="flex gap-2">
            <CreateTaskButton :workspace_id="props.workspace_id" />
            <InviteUserButton :workspace_id="props.workspace_id" />
        </div>

        <div v-if="!workspaceStore.currentWorkspace" class="text-gray-500">Loading workspace details...</div>
        <div v-else>
            <!-- Workspace details -->
            <h1 class="text-2xl font-bold">{{ workspaceStore.currentWorkspace.name }}</h1>
            <p class="text-gray-600">{{ workspaceStore.currentWorkspace.description }}</p>

            <hr />

            <div class="flex">
                <!-- Users -->
                <div class="flex flex-col gap-4 border-r p-2">
                    <h1 class="text-xl font-bold">Available assignees</h1>
                    <div v-if="workspaceStore.currentWorkspace.invites?.length > 0" class="space-y-4">
                        <div v-for="invite in workspaceStore.currentWorkspace.invites" :key="invite.id">
                            <h2 class="text-md font-bold">
                                {{ invite.email }}
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Tasks -->
                <div class="flex flex-col gap-4 p-2">
                    <h1 class="text-xl font-bold">Tasks</h1>
                    <div v-if="workspaceStore.currentWorkspace.tasks?.length > 0" class="space-y-4">
                        <div v-for="task in workspaceStore.currentWorkspace.tasks" :key="task.id">
                            <h2 class="text-lg font-bold">
                                <!-- Link to Task Details Page -->
                                <a :href="`/workspaces/${workspaceStore.currentWorkspace.id}/tasks/${task.id}`" class="text-blue-500 hover:underline">
                                    {{ task.title }}
                                </a>
                            </h2>
                            <p class="text-gray-600">{{ task.description }}</p>
                            <p class="text-sm text-gray-500">Owner: {{ task.owner_id }}</p>
                            <UpdateTaskButton :task="task" />
                            <AssignUserButton
                                :task="task"
                                :workspace_id="workspaceStore.currentWorkspace.id"
                                :memebers="workspaceStore.currentWorkspace.invites.map((invite) => invite.email)"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
