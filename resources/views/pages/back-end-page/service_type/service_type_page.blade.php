-@extends('layout.sidenav-layout')
@section('title','maintenance')
@section('content')
    @include('components.back-end.service-type.service_type_list')
    @include('components.back-end.service-type.service_type_create')
    @include('components.back-end.service-type.service_type_update')
    @include('components.back-end.service-type.service_type_delete')
@endsection
