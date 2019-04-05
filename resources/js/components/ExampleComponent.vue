<template>
    <div class="card">
        <div class="card-header">Add Task</div>
        <div class="card-body">
            <input type="text" class="form-control">
            <button class="btn btn-primary mt-2" @click="sendTask()">Add</button>
            <button class="btn btn-primary mt-2" @click="sendDefault()">sendDefault</button>
<!--            {{token}}-->
            <!--            <h3>{{calabaza}}</h3>-->
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
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
                // console.log('Añadiendo');
                let x;
                axios.get('/api/user').then(response => {console.log(response.data)});
            },
            sendDefault: function () {
                axios.get('./api/user?api_token='+this.token, null).then(function(response){
                    console.log(response.data);
                });
            }
        }
    }
</script>