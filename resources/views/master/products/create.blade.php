@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')

<div class="card">

    <div class="card-header">
        Tambah Produk
    </div>

    <div class="card-body">

        <form action="{{ route('master.products.store') }}"
              method="POST">

            @csrf

            @include('master.products.form')

        </form>

    </div>

</div>

@endsection