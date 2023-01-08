<template>
    <form class="row" method="POST" action="/todos/">
        <div class="col-md-6">
            <input class="form-check-input" type="checkbox" v-model="more.is_completed" :checked="more.is_completed" name="is_completed" @change="toggleTask" :disabled="more.isLoading">
            {{ task.name }}
        </div>
        <div class="col-md-6">
            <button class="btn btn-sm btn-danger d-block ms-auto me-0">Usuń</button>
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
        more.color = 'success'
        more.info = res.data.msg
        Inertia.reload()
    }).catch(err => {
        more.color = 'danger'
        if(err.response) {
            more.info = ''
            const message = JSON.parse(err.response.data.message)
            Object.values(message.errors).forEach(error => more.info += `${error}<br>`)
        } else {
            more.info = 'Nie udało się utworzyć zadania'
        }
    }).finally(() => more.isLoading = false)
}
</script>