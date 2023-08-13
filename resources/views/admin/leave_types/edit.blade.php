@extends('layouts.master')
@section('title', 'Edit ' . $leavetype->name . ' request')
@section('topTitle', 'Edit ' . $leavetype->name . ' request')
@section('content')

    @include('errors')

    <form action="{{ route('admin.leavetypes.update', $leavetype->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" class="form-control" id="name" placeholder="Name" name="name"
                value="{{ $leavetype->name }}">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
