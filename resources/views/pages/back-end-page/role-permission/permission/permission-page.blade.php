@extends('layout.sidenav-layout')
@section('title', 'Dashboard')
@section('content')
    @include('components.back-end.role-permission.permission.permission-list')
    @include('components.back-end.role-permission.permission.permission-create')
    @include('components.back-end.role-permission.permission.permission-update')
    @include('components.back-end.role-permission.permission.permission-delete')
@endsection
