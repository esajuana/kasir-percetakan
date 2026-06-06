@extends('layouts.admin')

@section('title', 'Edit Product Option')

@section('content')

<div class="card">

    <div class="card-header">
        Edit Product Option
    </div>

    <div class="card-body">

        <form
            action="{{ route('master.product-options.update', $option) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('master.product-options.form')

        </form>

    </div>

</div>

@endsection