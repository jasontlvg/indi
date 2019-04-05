@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 left-menu">
                <router-link to="/usersapi" class="">Users</router-link>
                <router-link to="/fakeusers" class="">fakeUsers</router-link>
                <router-link to="/cygnus" class="">Cygnus</router-link>
            </div>
            <div class="col-sm-10 pl py-2" >
                <router-view></router-view>
            </div>
        </div>
    </div>
@endsection