@extends('layout.app')


@section('title')
    Login page
@endsection

@section('content')
    @include('components.auth.login-form')


@endsection
