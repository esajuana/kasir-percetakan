@extends('layouts.admin')

@section('title', 'Tambah Finishing')

@section('content')

<div class="card">

    <div class="card-header">

        Tambah Finishing

    </div>

    <div class="card-body">

        <form
            action="{{ route('master.finishings.store') }}"
            method="POST">

            @csrf

            @include('master.finishings.form')

        </form>

    </div>

</div>

@endsection