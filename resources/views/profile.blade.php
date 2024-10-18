@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Bilgileri</h2>
    <table class="table table-bordered">
        <tr>
            <th>Kullanıcı Adı:</th>
            <td>{{ $username }}</td>
        </tr>
        <tr>
            <th>IP Adresi:</th>
            <td>{{ $ip }}</td>
        </tr>
        <tr>
            <th>Yetki:</th>
            <td>{{ $role }}</td>
        </tr>
    </table>
</div>
@endsection
