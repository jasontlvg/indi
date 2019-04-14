<template>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2>Profile</h2>
<!--            <h2>{{photo}}</h2>-->

        </div>

        <div class="card-body">
            <form action="" @submit.prevent="sendData">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" v-model="form.name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter email" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="name" v-model="form.email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" :class="{ 'is-invalid': form.errors.has('email') }">
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
                    <label for="photo"></label>
                    <input type="file" name="photo" class="form-input" id="photo" @change="imageProfile">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    <has-error :form="form" field="password"></has-error>
                </div>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <img :src="getPhoto()" alt="">
<!--        <p>{{prueba()}}</p>-->
    </div>
    
</template>

<script>
    export default {
        created() {
            // console.log('Component mounted.')
            this.loadUsers();
        },
        name: "profile",
        data: function () {
            return {
                photo: '',
                image64: '',
                form: new Form({
                    id: 0,
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                }),
                lala: {}
            }
        },
        methods:{
            prueba: function () {

            },
            getPhoto: function () {
                let photo= (this.form.photo.length > 200) ? this.form.photo : "img/profile/" + this.form.photo;
                return photo;
                // return 'img/' + this.form.photo;
            },
            loadUsers: function () {
                let x= this;
                axios.get('./api/user/profile')
                    .then(function (response) {
                        console.log(response.data);
                        x.lala= response.data;
                        x.form.fill(response.data)
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
            imageProfile: function(e){
                // console.log(e.target.files[0]);
                let file= e.target.files[0];
                console.log(file.size);
                let reader= new FileReader();
                reader.onloadend= () => {
                    console.log(reader.result);
                    this.form.photo= reader.result
                }
                reader.readAsDataURL(file);

                // Nuevo
            },
            sendData: function () {

                if(this.form.password === ""){
                    this.form.password= undefined;
                }

                this.form.put('api/user/updateprofile')
                    .then(({ data }) => { console.log(data) })
            }
        }
    }
</script>

<style scoped>

</style>