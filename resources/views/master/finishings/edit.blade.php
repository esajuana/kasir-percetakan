@extends('layouts.admin')

@section('title', 'Edit Finishing')

@section('content')

<div class="card">

    <div class="card-header">

        Edit Finishing

    </div>

    <div class="card-body">

        <form
            action="{{ route('master.finishings.update', $finishing) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('master.finishings.form')

        </form>

    </div>

</div>

@endsection