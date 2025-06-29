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
                <td><a href="" class="btn btn-sm btn-warning">Edit</a></td>
                <td>
                    <form method="post" action="">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-sm btn-danger">

                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection