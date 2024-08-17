@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student List</h1>
  <hr/>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    <div class="card mt-4">
        <div class="mt-3 pl-3">
            <button class="btn btn-primary p-3" data-toggle="modal" data-target="#addStudentModal"><i class="fa fa-plus"></i>  Add New Student</button>
        </div>
          
        <div class="card-body shadow">
        <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->subject_name }}</td>
                    <td>{{ $student->marks }}</td>
                    <td>
                        <button class="btn btn-success" onclick="openEditModal({{ $student->id }}, '{{ $student->name }}', '{{ $student->subject_name }}', {{ $student->marks }})"><i class="fa fa-edit"></i> Edit</button>
                        <form action="/students/{{ $student->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
    

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/students/add" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Student Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="subject_name">Subject Name</label>
                            <input type="text" class="form-control" name="subject_name" required>
                        </div>
                        <div class="form-group">
                            <label for="marks">Marks</label>
                            <input type="number" class="form-control" name="marks" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editStudentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Student Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_subject_name">Subject Name</label>
                            <input type="text" class="form-control" id="edit_subject_name" name="subject_name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_marks">Marks</label>
                            <input type="number" class="form-control" id="edit_marks" name="marks" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, name, subject_name, marks) {
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_subject_name').value = subject_name;
        document.getElementById('edit_marks').value = marks;

        const form = document.getElementById('editStudentForm');
        form.action = `/students/${id}`;

        $('#editStudentModal').modal('show');
    }
</script>

@endsection
