<template>
    <div class="card">
        <div class="card-header">Shield</div>
        <div class="card-body">
            <input type="text" class="form-control">
            <button class="btn btn-primary mt-2" @click="sendTask()">Add</button>
            <button class="btn btn-primary mt-2" @click="sendDefault()">sendDefault</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Component mounted.')
        },
        props:{
            token: String
        },
        data: function () {
            return{
                calabaza: true,
            }
        },
        methods:{
            sendTask: function () {
                console.log('Primero');
            },
            sendDefault: function () {
                console.log('Segundo');
            }
        }
    }
</script>