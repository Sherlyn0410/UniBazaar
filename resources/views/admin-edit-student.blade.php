@extends('layouts.admin-main')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Student</h3>

    <form method="POST" action="{{ route('admin.update.student', $student->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $student->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="contact" value="{{ old('contact', $student->contact) }}" class="form-control">
        </div>

    

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
    </form>
</div>
@endsection
