@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">
            Edit Kategori
        </h5>
    </div>

    <div class="card-body">

        <form
            action="{{ route('master.categories.update', $category) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('master.categories.form')

        </form>

    </div>

</div>

@endsection