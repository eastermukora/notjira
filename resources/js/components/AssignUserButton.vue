<script setup lang="ts">
import { TaskType, useWorkspacesStore } from '@/layouts/store/workspaces';
import { ref } from 'vue';
import { Dialog, DialogContent, DialogOverlay, DialogTrigger } from '../components/ui/dialog';

const props = defineProps<{
    task: TaskType;
    workspace_id: string;
    memebers: string[];
}>();

const workspacesStore = useWorkspacesStore();
const open = ref(false);

const form = ref({
    email: '',
});

const assignTask = () => {
    workspacesStore
        .assignTask({
            email: form.value.email,
            task_id: props.task.id,
            workspace_id: props.workspace_id,
        })
        .then(() => {
            open.value = false;
        })
        .catch((err) => {
            console.log(err);
            open.value = false;
        });
};
</script>

<template>
    <Dialog v-model:open="open">
        <DialogTrigger as-child>
            <button class="rounded bg-gray-200 px-4 py-2 text-blue-500">
                {{ task.assignee_email ?? 'Assign task' }}
            </button>
        </DialogTrigger>

        <DialogOverlay />

        <DialogContent>
            <select class="rounded-md border p-2" v-model="form.email">
                <option v-for="member in memebers" :key="member" :value="member">{{ member }}</option>
            </select>

            <button @click="assignTask" class="hover:bg-blue-650 mt-4 rounded bg-blue-500 px-4 py-2 text-white">Assign</button>
        </DialogContent>
    </Dialog>
</template>
