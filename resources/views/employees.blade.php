<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body class="container mt-5">

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
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
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
</body>
</html>
