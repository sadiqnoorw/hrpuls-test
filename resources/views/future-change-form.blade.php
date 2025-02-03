@extends('app')

@section('content')

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
            <input type="date" name="effective_date" min="<?= date('Y-m-d'); ?>" class="form-control @error('effective_date') is-invalid @enderror" required>
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
            <label class="form-label">Telephone</label>
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
@endsection
