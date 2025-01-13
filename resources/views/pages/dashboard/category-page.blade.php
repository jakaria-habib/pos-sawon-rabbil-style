@extends('layout.sidenav-layout')

@section('title')
    Category Page
@endsection


@section('content')

    @include('components.category.category-list')
    @include('components.category.category-create')
    @include('components.category.category-update')
    @include('components.category.category-delete')

@endsection
