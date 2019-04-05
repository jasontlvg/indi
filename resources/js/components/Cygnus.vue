<template>
    <div class="card">
        <div class="card-header">Cygnus</div>
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
                axios.get('./api/user', {
                    firstName: 'Fred',
                    lastName: 'Flintstone'
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            sendDefault: function () {
                console.log('Segundo');
            }
        }
    }
</script>