<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';

const route = useRoute(); // Get the workspace ID from the route
const workspace = ref(null); // Reactive variable to store workspace details

// Fetch workspace details from the backend
const fetchWorkspaceDetails = async () => {
    try {
        const response = await axios.get(`/workspaces/${route.params.id}`);
        workspace.value = response.data.workspace;
    } catch (error) {
        console.error('Error fetching workspace details:', error);
    }
};

// Fetch data when the component is mounted
onMounted(() => {
    fetchWorkspaceDetails();
});
</script>

<template>
    <div class="p-6 space-y-6">
        <div v-if="!workspace" class="text-gray-500">
            Loading workspace details...
        </div>
        <div v-else class="bg-white shadow rounded-lg p-4">
            <h1 class="text-2xl font-bold">{{ workspace.name }}</h1>
            <p class="text-gray-600">{{ workspace.description }}</p>
            <p class="text-sm text-gray-500">Owner: {{ workspace.owner.name }}</p>
        </div>
    </div>
</template>