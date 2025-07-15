import axios from 'axios';
import { defineStore } from 'pinia';

export type WorkspaceType = { name: string; description: string; id: number; owner_id: string };

export const useWorkspacesStore = defineStore('workspaces', {
    state: () => ({
        workspaces: [] as WorkspaceType[],
    }),
    actions: {
        async fetchWorkspaces() {
            const response = await axios.get('/api/workspaces');
            this.workspaces = response.data;
        },
        async fetchWorkspace(id: string) {
            const response = await axios.get(`/api/workspaces/${id}`);
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
    },
});
