<template>
     <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Utwórz zadanie</div>
                <div class="card-body">
                    <form @submit.prevent="submitHandler" action="/todos" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nazwa</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Wprowadź nazwę zadania" autocomplete="off" v-model="more.name">
                        </div>
                        <button type="submit" class="btn btn-primary ms-auto me-0 d-block" :disabled="more.isLoading">Utwórz</button>
                    </form>
                    <div v-if="more.info" :class="`alert alert-${more.color} mt-3`" v-html="more.info"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'


const more = reactive({
    isLoading: false,
    info: '',
    color: '',
    name: ''
})

const submitHandler = () => {
    more.isLoading = true
    axios.post('/todos', { name: more.name }).then(res => {
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