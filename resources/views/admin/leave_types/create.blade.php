@extends('layouts.master')
@section('title', 'Add New Leave Type')
@section('topTitle', 'Add New leave type')
@section('content')

@include('errors')

    <form action="{{ route('admin.leavetypes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" class="form-control" id="name" placeholder="Name" name="name">
        </div>
        <button class="btn btn-primary">Add</button>
    </form>
@endsection
