@extends('layouts.admin')

@section('title', 'Edit Harga Produk')

@section('content')

<div class="card">

    <div class="card-header">
        Edit Harga Produk
    </div>

    <div class="card-body">

        <form
            action="{{ route('master.product-prices.update', $price) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('master.product-prices.form')

        </form>

    </div>

</div>

@endsection