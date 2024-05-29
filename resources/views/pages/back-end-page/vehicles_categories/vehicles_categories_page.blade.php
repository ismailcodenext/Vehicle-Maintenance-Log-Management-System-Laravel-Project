@extends('layout.sidenav-layout')
@section('title','VehicleCateGory')
@section('content')
    @include('components.back-end.vehicles_category.vehicles_category_list')
    @include('components.back-end.vehicles_category.vehicles_category_create')
    @include('components.back-end.vehicles_category.vehicles_category_update')
    @include('components.back-end.vehicles_category.vehicles_category_delete')
{{--    @include('components.back-end.test.test-create')--}}
@endsection