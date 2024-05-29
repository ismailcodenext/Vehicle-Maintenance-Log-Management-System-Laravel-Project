@extends('layout.sidenav-layout')
@section('title','VehicleCateGory')
@section('content')
    @include('components.back-end.vehicles_catagory.vehicles_catagory_list')
    @include('components.back-end.vehicles_catagory.vehicles_catagory_create')
    @include('components.back-end.vehicles_catagory.vehicles_catagory_update')
    @include('components.back-end.vehicles_catagory.vehicles_catagory_delete')
{{--    @include('components.back-end.test.test-create')--}}
@endsection