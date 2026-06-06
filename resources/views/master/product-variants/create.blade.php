@extends('layouts.admin')

@section('title', 'Tambah Product Variant')

@section('content')

<div class="card">

    <div class="card-header">

        Tambah Product Variant

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

@include('master.product-variants.script')