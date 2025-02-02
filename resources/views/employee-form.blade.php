<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body class="container mt-5">

    <h1 class="mb-4">{{ isset($employee) ? 'Edit Employee' : 'Add Employee' }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
        @csrf
        @if(isset($employee))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name ?? '') }}" >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee->email ?? '') }}" >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Telephone</label>
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $employee->telephone ?? '') }}" >
            @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $employee->address ?? '') }}" >
        </div>
        
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $employee->title ?? '') }}">
        </div>

        <button type="submit" class="btn btn-success">{{ isset($employee) ? 'Update' : 'Save' }}</button>
        <a href="{{ route('employees') }}" class="btn btn-secondary">Back</a>
    </form>

</body>
</html>
