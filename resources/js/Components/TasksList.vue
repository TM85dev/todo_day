<template>
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Lista zadań</div>
                <div class="card-body">
                    <!-- LINKS -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li v-for="(link, _) in links" :key="_" class="nav-item" role="presentation">
                            <button :class="`nav-link ${_ ? '' : 'active' }`" :id="`${link.value}-tab`" data-bs-toggle="tab" :data-bs-target="`#${link.value}`" type="button" role="tab">
                                {{ link.name }}
                            </button>
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
import { usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const links = [
    { name: 'W toku', value: 'progress' },
    { name: 'Zakończone', value: 'done' },
]
const todos_completed = computed(() => {
    return usePage().props.value.todos.filter(item => item.is_completed)
})
const todos_progress = computed(() => {
    return usePage().props.value.todos.filter(item => !item.is_completed)
})
</script>