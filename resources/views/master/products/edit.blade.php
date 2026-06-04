@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

<div class="card">

    <div class="card-header">
        Tambah Produk
    </div>

    <div class="card-body">

        <form action="{{ route('master.products.update', $product) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('master.products.form')

        </form>

    </div>

</div>

@endsection