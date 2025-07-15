import axios from 'axios';
import { defineStore } from 'pinia';

export type WorkspaceType = { name: string; description: string; id: number; owner_id: string };
export type TaskType = {
    title: string;
    description: string;
    id?: string;
    workspace_id: string;
    deadline: string;
    status: string;
    assignee_id: string;
};
export type InviteUserType = {
    workspace_id: string;
    email: string;
};

export const useWorkspacesStore = defineStore('workspaces', {
    state: () => ({
        workspaces: [] as WorkspaceType[],
        currentWorkspace: {} as WorkspaceType,
    }),
    actions: {
        async fetchWorkspaces() {
            const response = await axios.get('/api/workspaces');
            this.workspaces = response.data;
        },
        async fetchWorkspace(id: string) {
            const response = await axios.get(`/api/workspaces/${id}`);
            this.currentWorkspace = response.data as WorkspaceType;
            return response.data as WorkspaceType;
        },
        async createWorkspace(name: string, description: string) {
            try {
                const response = await axios.post('/api/workspaces', {
                    name,
                    description,
                });
                this.workspaces = [...this.workspaces, response.data];
            } catch (error) {
                console.error('Error creating workspace:', error);
            }
        },
        async createTask(form: TaskType) {
            try {
                await axios.post(`/api/workspaces/${form.workspace_id}/tasks`, {
                    ...form,
                });
                // update store data
                this.fetchWorkspace(form.workspace_id);
            } catch (error) {
                console.error('Error creating task:', error);
                throw error;
            }
        },
        async updateTask(form: TaskType) {
            try {
                await axios.put(`/api/workspaces/${form.workspace_id}/tasks/${form.id}`, {
                    ...form,
                });
                // update store data
                this.fetchWorkspace(form.workspace_id);
            } catch (error) {
                console.error('Error updating task:', error);
            }
        },
        async inviteUser(form: InviteUserType) {
            try {
                await axios.post(`/api/workspaces/${form.workspace_id}/invites`, {
                    ...form,
                });
                // update store data
                this.fetchWorkspace(form.workspace_id);
            } catch (error) {
                console.error('Error inviting user:', error);
            }
        },

        async assignTask(form: { email: string; task_id: string; workspace_id: string }) {
            try {
                await axios.post(`/api/workspaces/${form.workspace_id}/tasks/${form.task_id}/assign`, {
                    ...form,
                });
                // update store data
                this.fetchWorkspace(form.workspace_id);
            } catch (error) {
                console.error('Error assigning task:', error);
            }
        },
    },
});
