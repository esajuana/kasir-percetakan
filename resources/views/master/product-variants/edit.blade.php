@extends('layouts.admin')

@section('title', 'Edit Variant Produk')

@section('content')

<div class="card">

    <div class="card-header">
        Edit Variant Produk
    </div>

    <div class="card-body">

        <form
            action="{{ route('master.product-variants.update', $variant) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('master.product-variants.form')

        </form>

    </div>

</div>

@endsection