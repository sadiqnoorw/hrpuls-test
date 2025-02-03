@extends('app')

@section('content')
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
@endsection