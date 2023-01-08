<template>
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Lista zadań</div>
                <div class="card-body">
                    <!-- LINKS -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress" type="button" role="tab" aria-controls="progress" aria-selected="true">W toku</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="done-tab" data-bs-toggle="tab" data-bs-target="#done" type="button" role="tab" aria-controls="done" aria-selected="false">Zakończone</button>
                        </li>
                    </ul>
                    <!-- TABS -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <label v-for="task in todos_progress" class="list-group-item" :key="task.id">
                                            <Task :task="task" />
                                        </label>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                            <div class="card-body">
                                <ul class="list-group">
                                    <label v-for="task in todos_completed" class="list-group-item" :key="task.id">
                                        <Task :task="task" />
                                    </label>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Task from '@/Components/Task.vue'
import { Inertia } from '@inertiajs/inertia'
import { usePage } from '@inertiajs/inertia-vue3'
import { computed, ref } from 'vue'

const todos_completed = computed(() => {
    // Inertia.reload({ only: ['todos'] })
    // key.value += 1
    return usePage().props.value.todos.filter(item => item.is_completed)
})
const todos_progress = computed(() => {
    // key.value += 1
    // Inertia.reload({ only: ['todos'] })
    return usePage().props.value.todos.filter(item => !item.is_completed)
})
</script>