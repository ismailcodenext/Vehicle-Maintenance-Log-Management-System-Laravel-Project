@extends('layout.sidenav-layout')
@section('title', 'Dashboard')
@section('content')
    @include('components.back-end.role-permission.role.role-list')
    @include('components.back-end.role-permission.role.role-create')
    @include('components.back-end.role-permission.role.role-update')
    @include('components.back-end.role-permission.role.role-delete')
@endsection
