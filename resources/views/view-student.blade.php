@extends('layouts.admin-main')

@section('content')
    <h3 class="mb-4 fw-semibold text-dark">List of Student</h3>

    <table class="table table-striped table-bordered align-middle mx-auto">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Student Contact</th>
                <th>Action</th>
                <th>Action</th>
           </tr>
        </thead>

        <tbody>
        @foreach ($students as $student)  
            <tr>
                <td>{{$student ->id}}</td>
                <td>{{$student ->name}}</td>
                <td> {{$student ->email}}</td>
                <td>{{$student ->contact}}</td>
                <td>
                    
                   <form method="POST" action="{{ route('admin.student.delete', $student->id) }}">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">
</form>

                </td>
                <td>    <a href="{{ route('admin.edit.student', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection