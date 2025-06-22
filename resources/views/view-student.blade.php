<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - List of Student</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
          <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Custom CSS for Sidebar -->
</head>
<body>



    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="container">
            <h1>List of Student</h1>

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
          </table>
       </div>
    </div>
</div>
