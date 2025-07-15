<script setup lang="ts">
import { Input } from '@/components/ui/input';
import { InviteUserType, useWorkspacesStore } from '@/layouts/store/workspaces';
import { ref } from 'vue';
import { Dialog, DialogContent, DialogDescription, DialogOverlay, DialogTitle, DialogTrigger } from '../components/ui/dialog';

const props = defineProps<{
    workspace_id: string;
}>();

const workspacesStore = useWorkspacesStore();
const open = ref(false);

const form = ref<InviteUserType>({
    workspace_id: props.workspace_id,
    email: '',
});

const inviteUser = async () => {
    workspacesStore
        .inviteUser(form.value)
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
            <button class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Invite user</button>
        </DialogTrigger>

        <DialogOverlay />

        <DialogContent>
            <DialogTitle>Invite User</DialogTitle>
            <DialogDescription> Fill in the details to invite a user to the workspace. </DialogDescription>
            <Input v-model="form.email" placeholder="Email" />

            <hr />
            <button @click="inviteUser" class="hover:bg-blue-650 mt-4 rounded bg-blue-500 px-4 py-2 text-white">Invite</button>
        </DialogContent>
    </Dialog>
</template>
