@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="column ">
                <passport-clients></passport-clients>
            </div>
            <div class="column mx-1">
                <passport-authorized-clients></passport-authorized-clients>
            </div>
            <div class="column">
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
        <div class="row">
            <example-component></example-component>
        </div>
    </div>
@endsection