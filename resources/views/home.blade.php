@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <sidebar-admin-component></sidebar-admin-component>
        <div class="col-md-8">
            <router-view></router-view>
        </div>
    </div>
</div>
@endsection
