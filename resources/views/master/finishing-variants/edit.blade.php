@extends('layouts.admin')

@section('title', 'Edit Finishing Variant')

@section('content')

<div class="card">

    <div class="card-header">

        Edit Finishing Variant

    </div>

    <div class="card-body">

        <form
            action="{{ route(
                'master.finishing-variants.update',
                $variant->id
            ) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include(
                'master.finishing-variants.form'
            )

        </form>

    </div>

</div>

@endsection

@include('master.finishing-variants.script')