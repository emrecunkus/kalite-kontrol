<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')

 <!-- Başarı Mesajı -->

<div class="container"> 
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Dashboard</h1>
    <p>Welcome to the ASPİLSAN Kalite Portal Dashboard!</p>
</div>
@endsection
