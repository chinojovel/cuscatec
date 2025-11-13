@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
    @include('users.form', ['user' => $user])
@endsection
