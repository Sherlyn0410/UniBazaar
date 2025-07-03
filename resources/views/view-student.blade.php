@extends('layouts.admin-main')

@section('content')
    <h3 class="mb-4 fw-semibold">List of Students</h3>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff;">
            <thead class="table-secondary align-middle">
                <tr>
                    <th class="text-center">ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th colspan="2" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)  
                    <tr>
                        <td class="text-center fw-semibold">{{ $student->id }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if(!empty($student->profile_image) && file_exists(public_path('assets/img/' . $student->profile_image)))
                                    <img src="{{ asset('assets/img/' . $student->profile_image) }}"
                                        alt="Profile"
                                        class="rounded-circle border shadow"
                                        style="width: 32px; height: 32px; object-fit: cover;">
                                @else
                                    <span class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center"
                                          style="width:32px; height:32px;">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                @endif
                                <span>{{ $student->name }}</span>
                            </div>
                        </td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->contact }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.edit.student', $student->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.student.delete', $student->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete" onclick="return confirm('Are you sure you want to delete this student?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection