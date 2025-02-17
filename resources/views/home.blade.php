@extends('layouts.app')

@section('content')
    <h1>Добро пожаловать, {{ auth()->user()->name }}</h1>
    <p>Ваша роль: {{ auth()->user()->role }}</p>
@endsection
