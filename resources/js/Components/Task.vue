<template>
    <form class="row" method="POST" action="/todos/">
        <div class="col-6">
            <input class="form-check-input" type="checkbox" v-model="more.is_completed" :checked="more.is_completed" name="is_completed" @change="toggleTask" :disabled="more.isLoading">
            {{ task.name }}
        </div>
        <div class="col-6">
            <button @click="deleteTask" class="btn btn-sm btn-danger d-block ms-auto me-0" :disabled="more.isLoading">Usuń</button>
        </div>
    </form>
</template>

<script setup>
import { reactive } from 'vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'

const { task } = defineProps({
    task: {
        type: Object,
        require: true
    }
})
const more = reactive({
    isLoading: false,
    info: '',
    color: '',
    is_completed: Boolean(task.is_completed)
})

const toggleTask = () => {
    more.isLoading = true
    axios.patch(`/todos/${task.id}`, { is_completed: more.is_completed }).then(res => {
        Inertia.reload({ only: ['todos'] })
    }).catch(err => {
    }).finally(() => more.isLoading = false)
}
const deleteTask = () => {
    more.isLoading = true
    axios.delete(`/todos/${task.id}`).then(res => {
        Inertia.reload({ only: ['todos'] })
    }).catch(err => {
    }).finally(() => more.isLoading = false)
}
</script>