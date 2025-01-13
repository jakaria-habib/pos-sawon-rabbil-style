@extends('layout.sidenav-layout')

@section('title')
    Invoice Page
@endsection

@section('content')

    @include('components.invoice.invoice-list')
    @include('components.invoice.invoice-details')
    @include('components.invoice.invoice-delete')

@endsection
