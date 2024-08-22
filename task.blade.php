<?php
use PHP_Task\Classes\Models\Task;

include 'includes/header.blade.php';
include 'includes/alerts/success.blade.php';
include 'includes/alerts/errors.blade.php';
include 'includes/Models/Task/create.blade.php';
include 'includes/Models/Task/edit.blade.php';

$tas = new Task();
$userId = $session->get('id');
$isUser = false;

if (empty($managerName)) {
    $tasks = $tas->selectAllWithUser('created_by', $userId);
} else {
    $tasks = $tas->selectAllWithUser('user_id', $userId);
    $isUser = true;
}

// echo '<pre>';
// print_r($tasks);
// echo '<pre>';

?>


<div class="container mt-5">
    <div class="border rounded p-5 bg-light bg-gradient">
        <h1 class="h5">Tasks</h1>

        <?php if (empty($managerName)) : ?>
        <div class="d-flex justify-content-end mb-3">

            <form method="post" action="<?= URL ?>Handler/handler-logout.php">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create
                </button>
            </form>
        </div>
        <?php endif; ?>

        <div class="row g-3">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Assign To</th>
                            <th scope="col">Status</th>
                            <?php if ($isUser) : ?>

                            <th scope="col">Update Status</th>

                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $counter = 1; ?>
                        <?php foreach ($tasks as $item): ?>
                        <tr>
                            <th scope="row"><?= $counter++ ?></th>
                            <td><?= htmlspecialchars($item['title']) ?></td>
                            <td><?= htmlspecialchars($item['description']) ?></td>

                            <td><?= htmlspecialchars($item['first_name']) . ' ' . htmlspecialchars($item['last_name']) ?>
                            </td>

                            
                            <td><?= htmlspecialchars($item['status']) ?></td>


                            <?php if ($isUser) : ?>

                            <td>
                                <a href="#" class="text-warning edit-link"
                                    data-id="<?= htmlspecialchars($item['id']) ?>">
                                    Edit
                                </a>
                            </td>

                            <?php endif; ?>
                            <!--
                            <td>
                                <a href="#" class="text-warning edit-link"
                                    data-id="<?= htmlspecialchars($item['id']) ?>"
                                    data-title="<?= htmlspecialchars($item['title']) ?>"
                                    data-description="<?= htmlspecialchars($item['description']) ?>"
                                    data-status="<?= htmlspecialchars($item['status']) ?>">
                                    Edit
                                </a>


                                &nbsp;
                                <a href="<?= URL . 'Handler/handler-delete-department.php?id=' . htmlspecialchars($item['id']) ?>"
                                    class="text-danger"
                                    onclick="return confirm('Are you sure you want to delete this employee?');">
                                    Delete
                                </a>
                            </td>
                        -->
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.edit-link').on('click', function(e) {
            e.preventDefault();

            var taskId = $(this).data('id');

            $('#taskId').val(taskId);

            $('#editModal').modal('show');
        });
    });
</script>


<?php include 'includes/footer.blade.php'; ?>
