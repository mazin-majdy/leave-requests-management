@extends('layouts.master')
@section('addNew')
    <a href="{{ route('admin.employees.create') }}" class="btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10">
        Add New
    </a>
@endsection
@section('content')
    @if ($msg)
        <div class="alert alert-success">{{ $msg }}</div>
    @endif
    <div class="row">
        <div class="col-12">
            <form action="{{ URL::current() }}" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button class="input-group-text btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <table class="table table-hover">
                <thead class="table-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>
                                <a href="{{ route('admin.employees.edit', $employee->id) }}"
                                    class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-outline-danger btn-delete"><i
                                        class="fa-solid fa-trash"></i></button>
                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $employees->withQueryString()->links() }}
    </div>
@endsection

@push('scripts')
    <x-delete-btn />
@endpush
