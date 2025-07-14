<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { DialogRoot, DialogTrigger, DialogOverlay, DialogContent, DialogTitle, DialogDescription } from 'reka-ui';

const name = ref('');
const description = ref('');

const createWorkspace = () => {
    router.post(route('workspaces.store'), {
        name: name.value,
        description: description.value,
    }, {
        onSuccess: () => {
            name.value = '';
            description.value = '';
        },
        onError: (errors: Record<string, string | string[]>) => {
            console.error('Error creating workspace:', errors);
        },
    });
};
</script>

<template>
    <DialogRoot>
        <DialogTrigger as-child>
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Create Workspace
            </button>
        </DialogTrigger>
        <DialogOverlay />
        <DialogContent>
            <DialogTitle>Create New Workspace</DialogTitle>
            <DialogDescription>
                Fill in the details to create a new workspace.
            </DialogDescription>
            <input v-model="name" class="border rounded p-2 w-full" placeholder="Workspace Name" />
            <input v-model="description" class="border rounded p-2 w-full mt-2" placeholder="Workspace Description" />
            <button @click="createWorkspace" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-650 mt-4">
                Create
            </button>
        </DialogContent>
    </DialogRoot>
</template>