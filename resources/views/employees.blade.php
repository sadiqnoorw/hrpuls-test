@extends('app')

@section('content')

    <h1 class="mb-4">Employee List</h1>
    
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Address</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->telephone }}</td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->title }}</td>
                <td>
                    
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('future-changes.create', $employee->id) }}" class="btn btn-warning btn-sm">Future changes</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<!-- Add Pagination Links -->
<div class="pagination">
    {{ $employees->links('pagination::bootstrap-4') }}
</div>
@endsection
