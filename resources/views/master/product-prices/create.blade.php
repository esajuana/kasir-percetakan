@extends('layouts.admin')

@section('title', 'Tambah Harga Produk')

@section('content')

<div class="card">

    <div class="card-header">
        Tambah Harga Produk
    </div>

    <div class="card-body">

        <form
            action="{{ route('master.product-prices.store') }}"
            method="POST">

            @csrf

            @include('master.product-prices.form')

        </form>

    </div>

</div>

@endsection