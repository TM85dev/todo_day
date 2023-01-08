<template>
    <GuestLayout>
        <!-- CREATE TASK -->
       <CreateTask />
       <TasksList />
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import CreateTask from '@/Components/CreateTask.vue'
import TasksList from '@/Components/TasksList.vue'

</script>