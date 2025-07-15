<script setup lang="ts">
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { TaskType, useWorkspacesStore } from '@/layouts/store/workspaces';
import { ref } from 'vue';
import { Dialog, DialogContent, DialogDescription, DialogOverlay, DialogTitle, DialogTrigger } from '../components/ui/dialog';

const props = defineProps<{
    task: TaskType;
}>();

const statusOptions = ['TODO', 'IN_PROGRESS', 'DONE'];

const workspacesStore = useWorkspacesStore();
const open = ref(false);

const form = ref<TaskType>(props.task);

const createTask = () => {
    workspacesStore
        .updateTask(form.value)
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
            <button class="rounded bg-gray-200 px-4 py-2 text-blue-500">{{ form.id ? 'Update task' : 'Create task' }} task</button>
        </DialogTrigger>

        <DialogOverlay />

        <DialogContent>
            <DialogTitle>Create New Workspace</DialogTitle>
            <DialogDescription> Fill in the details to create a new workspace. </DialogDescription>
            <Input v-model="form.title" placeholder="Title" />
            <textarea v-model="form.description" class="rounded-md border p-2" placeholder="Description" />
            <Label> Deadline </Label>
            <Input v-model="form.deadline" placeholder="Deadline" type="date" />
            <Label> Status </Label>
            <select class="rounded-md border p-2" v-model="form.status">
                <option v-for="status in statusOptions" :key="status" :value="status">{{ status }}</option>
            </select>

            <hr />
            <button @click="createTask" class="hover:bg-blue-650 mt-4 rounded bg-blue-500 px-4 py-2 text-white">Update</button>
        </DialogContent>
    </Dialog>
</template>
