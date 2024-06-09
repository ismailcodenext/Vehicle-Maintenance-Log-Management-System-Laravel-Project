@extends('layout.sidenav-layout')
@section('title', 'Dashboard')
@section('content')
    @include('components.back-end.role-permission.all-roles-permission.roles-permission-list')
    @include('components.back-end.role-permission.all-roles-permission.roles-permission-create')
    @include('components.back-end.role-permission.all-roles-permission.roles-permission-delete')
    @include('components.back-end.role-permission.all-roles-permission.roles-permission-update')
@endsection

