@extends('layouts.admin')

@section('title', 'Tambah Variant Produk')

@section('content')

<div class="card">

    <div class="card-header">
        Tambah Variant Produk
    </div>

    <div class="card-body">

        <form
            action="{{ route('master.product-variants.store') }}"
            method="POST">

            @csrf

            @include('master.product-variants.form')

        </form>

    </div>

</div>

@endsection