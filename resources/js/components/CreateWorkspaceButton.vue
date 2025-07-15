<script setup lang="ts">
import { ref } from 'vue';
import { Dialog, DialogContent, DialogDescription, DialogOverlay, DialogTitle, DialogTrigger } from '../components/ui/dialog';
import { useWorkspacesStore } from '../layouts/store/workspaces';

const name = ref('');
const description = ref('');

const workspacesStore = useWorkspacesStore();
const open = ref(false);

const createWorkspace = async () => {
    workspacesStore
        .createWorkspace(name.value, description.value)
        .then(() => {
            open.value = false;
        })
        .catch((err) => {
            console.log(err);
            open.value = true;
        });
};
</script>

<template>
    <Dialog v-model:open="open">
        <DialogTrigger as-child>
            <button class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Create Workspace</button>
        </DialogTrigger>
        <DialogOverlay />
        <DialogContent>
            <DialogTitle>Create New Workspace</DialogTitle>
            <DialogDescription> Fill in the details to create a new workspace. </DialogDescription>
            <input v-model="name" class="w-full rounded border p-2" placeholder="Workspace Name" />
            <input v-model="description" class="mt-2 w-full rounded border p-2" placeholder="Workspace Description" />
            <button @click="createWorkspace" class="hover:bg-blue-650 mt-4 rounded bg-blue-500 px-4 py-2 text-white">Create</button>
        </DialogContent>
    </Dialog>
</template>
