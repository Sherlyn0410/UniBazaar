@extends('layouts.admin-main')

@section('content')
    <h3 class="mb-4 fw-semibold">List of Students</h3>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle shadow-sm rounded-4 overflow-hidden mx-auto" style="background: #fff;">
            <thead class="table-secondary align-middle">
                <tr>
                    <th class="text-center">#</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th colspan="2" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $index => $student)  
                    <tr>
                        <td class="text-center fw-semibold">{{ $index + 1 }}</td>
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
                                <form method="POST" action="{{ route('admin.student.delete', $student->id) }}" class="delete-student-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Delete student with confirm and processing alert
        document.querySelectorAll('.delete-student-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will delete the student and all their products.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Processing',
                            text: 'Deleting student...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection