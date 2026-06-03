@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">
            Tambah Kategori
        </h5>
    </div>

    <div class="card-body">

        <form
            action="{{ route('master.categories.store') }}"
            method="POST">

            @csrf

            @include('master.categories.form')

        </form>

    </div>

</div>

@endsection