<template>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2>Starforce</h2>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add New User
            </button>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" @submit.prevent="submitUser" ref="exia">
                        <div class="modal-body">
                            <input type="text" name="este" class="modal-body__input">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="fakeUser in fakeUsers">
                <th scope="row">{{fakeUser.id}}</th>
                <td>{{fakeUser.name}}</td>
                <td>{{fakeUser.email}}</td>
                <td>{{fakeUser.phone}}</td>
            </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" @click="paginacion">
            Siguiente
        </button>
    </div>
</template>

<script>
    export default {
        created() {
            // console.log('Component mounted.')
            this.loadUsers();
        },
        props:{
            token: String
        },
        data: function () {
            return{
                calabaza: true,
                fakeUsers: {},
                currentPage: 0
            }
        },
        methods:{
            sendTask: function () {
                console.log('Primero');
            },
            sendDefault: function () {
                console.log('Segundo');
            },
            submitUser: function () {
                // console.log(this.$refs.exia.este.value);
                let bodyFormData = new FormData();
                bodyFormData.set('userName', 'Fred');
                bodyFormData.set('password', 'admin');
                axios({
                    method: 'post',
                    url: '/api/user/prime',
                    data: bodyFormData,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                })
                    .then(function (response) {
                        //handle success
                        console.log(response.data.userName);
                    })
                    .catch(function (response) {
                        //handle error
                        console.log(response);
                    });
                // console.log(bodyFormData);
            },
            loadUsers: function () {
                // axios.get('./api/user/prime').then( ({data}) => (this.fakeUsers= data.data));
                axios.get('./api/user/prime').then( ({data}) => {
                    this.currentPage= data.current_page;
                    this.fakeUsers= data.data;
                    console.log(data)
                });
            },
            paginacion: function(){
                axios.get(`./api/user/prime?page=${this.currentPage+1}`).then( ({data}) => {
                    this.currentPage= data.current_page;
                    this.fakeUsers= data.data;
                    console.log(data)
                });
            },
            mounted: function(){
                this.loadUsers();
            }
        }
    }
</script>

<style scoped>
    h2{
        font-size: 29px;
        margin: 0;
    }
    .modal-body__input{
        display: block;
        width: 100%;
    }
</style>