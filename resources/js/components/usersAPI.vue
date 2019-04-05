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
                            <div class="form-group">
                                <label for="name" @click="lala">Name</label>
                                <input name="name" v-model="form.name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter email" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" v-model="form.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Biography for User</label>
                                <textarea v-model="form.bio" class="form-control" id="exampleFormControlTextarea1" rows="3" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select User Role</label>
                                <select v-model="form.type"  class="form-control" id="exampleFormControlSelect1" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option>Admin</option>
                                    <option>Standar User</option>
                                    <option>Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                <has-error :form="form" field="password"></has-error>
                            </div>
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
                <th scope="col">Type</th>
                <th scope="col">Modify</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="fakeUser in fakeUsers" class="prime">
                <th scope="row">{{fakeUser.id}}</th>
                <td>{{fakeUser.name}}</td>
                <td>{{fakeUser.email}}</td>
                <td>{{fakeUser.type}}</td>
                <td>
<!--                    <a href="#">-->
                        <i class="fas fa-edit"></i>
<!--                    </a>-->
                    /
<!--                    <a href="#">-->
                        <i class="fas fa-trash-alt" @click="deleteUser(fakeUser.id)"></i>
<!--                    </a>-->
                </td>
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
                currentPage: 0,
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
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
                // console.log('Exito')
                this.$Progress.start()
                let ax= this;
                this.form.post('api/user').then(({ data }) => { console.log(data)}).catch(function (error) {
                    // handle error
                    console.log('errorrr');
                    ax.$Progress.fail()
                });
                // this.form.reset();
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
            },
            lala: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'Do you want to continue',
                    type: 'question',
                    confirmButtonText: 'Cool'
                })
            },
            deleteUser: function (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
                console.log(id)
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
    .prime td, .prime th, tr th{
        text-align: center;
    }
    tr td i{
        cursor: pointer;
    }
</style>