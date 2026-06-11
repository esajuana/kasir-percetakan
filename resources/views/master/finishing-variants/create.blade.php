@extends('layouts.admin')

@section('title', 'Tambah Finishing Variant')

@section('content')

<div class="card">

    <div class="card-header">

        Tambah Finishing Variant

    </div>

    <div class="card-body">

        <form
            action="{{ route('master.finishing-variants.store') }}"
            method="POST">

            @csrf

            @include(
                'master.finishing-variants.form'
            )

        </form>

    </div>

</div>

@endsection

@include(
    'master.finishing-variants.script'
)