@extends('layouts.admin')

@section('title', 'Tambah Product Option')

@section('content')

<div class="card">

    <div class="card-header">
        Tambah Product Option
    </div>

    <div class="card-body">

        <form
            action="{{ route('master.product-options.store') }}"
            method="POST">

            @csrf

            @include('master.product-options.form')

        </form>

    </div>

</div>

@endsection