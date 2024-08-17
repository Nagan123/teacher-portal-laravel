<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Student List</h1>
  <hr/>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('danger')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('danger')); ?>

        </div>
    <?php endif; ?>
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
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($student->name); ?></td>
                    <td><?php echo e($student->subject_name); ?></td>
                    <td><?php echo e($student->marks); ?></td>
                    <td>
                        <button class="btn btn-success" onclick="openEditModal(<?php echo e($student->id); ?>, '<?php echo e($student->name); ?>', '<?php echo e($student->subject_name); ?>', <?php echo e($student->marks); ?>)"><i class="fa fa-edit"></i> Edit</button>
                        <form action="/students/<?php echo e($student->id); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
        </div>
    </div>
    

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/students/add" method="POST">
                <?php echo csrf_field(); ?>
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
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\teacher-portal\resources\views/home.blade.php ENDPATH**/ ?>