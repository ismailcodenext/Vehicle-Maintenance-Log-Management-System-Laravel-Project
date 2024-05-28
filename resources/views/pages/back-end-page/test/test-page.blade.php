@extends('layout.sidenav-layout')
@section('title','Dashboard')
@section('content')
    @include('components.back-end.test.test-list')
    @include('components.back-end.test.test-create')
    @include('components.back-end.test.test-update')
    @include('components.back-end.test.test-delete')
{{--    @include('components.back-end.test.test-create')--}}
@endsection
