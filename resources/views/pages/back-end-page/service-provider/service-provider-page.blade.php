@extends('layout.sidenav-layout')
@section('title', 'Dashboard')
@section('content')
    @include('components.back-end.service-provider.service-provider-list')
    @include('components.back-end.service-provider.service-provider-create')
    @include('components.back-end.service-provider.service-provider-update')
    @include('components.back-end.service-provider.service-provider-delete')
    {{--    @include('components.back-end.service-provider.service-provider-create') --}}
@endsection
