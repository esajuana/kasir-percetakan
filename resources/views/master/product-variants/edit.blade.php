@extends('layouts.admin')

@section('title', 'Edit Product Variant')

@section('content')

<div class="card">

    <div class="card-header">

        Edit Product Variant

    </div>

    <div class="card-body">

        <form
            action="{{ route(
                'master.product-variants.update',
                $variant
            ) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('master.product-variants.form')

        </form>

    </div>

</div>

@endsection

@include('master.product-variants.script')