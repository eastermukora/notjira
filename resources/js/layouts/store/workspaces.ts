import axios from 'axios';
import { defineStore } from 'pinia';

export const useWorkspacesStore = defineStore('workspaces', {
    state: () => ({
        workspaces: [] as { name: string; description: string; id: number; owner_id: string }[],
    }),
    actions: {
        async fetchWorkspaces() {
            const response = await axios.get('/workspaces');
            this.workspaces = response.data;
        },
        async createWorkspace(name: string, description: string) {
            try {
                const response = await axios.post('/workspaces', {
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
