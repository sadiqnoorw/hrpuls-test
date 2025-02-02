<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Future Change</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body class="container mt-5">

    <h1 class="mb-4">Schedule Future Change for {{ $employee->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('future-changes.store', $employee->id) }}" method="POST">
        @csrf
    
        <!-- Effective Date Field -->
        <div class="mb-3">
            <label class="form-label">Effective Date <small class="text-muted">(When should the changes take effect?)</small></label>
            <input type="date" name="effective_date" class="form-control @error('effective_date') is-invalid @enderror" required>
            @error('effective_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <!-- Editable Fields -->
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $employee->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter new name if applicable">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter new email if applicable">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label">Telephone (e.g. international format +12345678900)</label>
            <input type="text" name="telephone" value="{{ old('phone', $employee->telephone) }}" class="form-control @error('telephone') is-invalid @enderror" placeholder="Enter new telephone number if applicable">
            @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" value="{{ old('address', $employee->address) }}" class="form-control @error('address') is-invalid @enderror" placeholder="Enter new address if applicable">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $employee->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter new title if applicable">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Schedule Change</button>
        <a href="{{ route('employees') }}" class="btn btn-secondary">Back</a>
    </form>
    
    

</body>
</html>
