@extends('layout.sidenav-layout')
@section('title','Vehicles Documents')
@section('content')
    @include('components.back-end.vehicles_documents.vehicle_documents_list')
    @include('components.back-end.vehicles_documents.vehicle_documents_create')
    @include('components.back-end.vehicles_documents.vehicle_documents_update')
    @include('components.back-end.vehicles_documents.vehicle_documents_delete')
@endsection
