@extends('layouts.master')
@section('title', 'Add New Employee')
@section('topTitle', 'Add New Employee')
@section('content')

@include('errors')

    <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" class="form-control" id="name" placeholder="Name" name="name" value="{{ $employee->name }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $employee->email }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
@endsection
