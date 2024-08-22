<?php
use PHP_Task\Classes\Models\Department;
include 'includes/header.blade.php';
include 'includes/alerts/success.blade.php';
include 'includes/alerts/errors.blade.php';
include 'includes/Models/Department/create.blade.php';
include 'includes/Models/Department/search.blade.php';
include 'includes/Models/Department/edit.blade.php';

$dep = new Department();
$deparments = $dep->selectAll();
?>


<div class="container mt-5">
    <div class="border rounded p-5 bg-light bg-gradient">
        <h1 class="h5">Departments</h1>

        <?php if (empty($managerName)) : ?>
        <div class="d-flex justify-content-end mb-3">

            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#searchModal">
                Search
            </button>

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
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $counter = 1; ?>
                        <?php foreach ($departments as $item): ?>
                        <tr>
                            <th scope="row"><?= $counter++ ?></th>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td>
                                <a href="#" class="text-warning edit-link"
                                    data-id="<?= htmlspecialchars($item['id']) ?>"
                                    data-name="<?= htmlspecialchars($item['name']) ?>">
                                    Edit
                                </a>


                                &nbsp;
                                <a href="<?= URL . 'Handler/handler-delete-department.php?id=' . htmlspecialchars($item['id']) ?>"
                                    class="text-danger"
                                    onclick="return confirm('Are you sure you want to delete this employee?');">
                                    Delete
                                </a>
                            </td>
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

            var departmentId = $(this).data('id');
            var departmentName = $(this).data('name');

            $('#departmentId').val(departmentId);
            $('#departmentName').val(departmentName);

            $('#editModal').modal('show');
        });
    });


    $('#searchInput').on('input', function() {
        var query = $(this).val();
        console.log(query);

        if (query.length > 0) {
            $.ajax({
                url: 'Handler/handler-search-department.php',
                type: 'GET',
                data: {
                    name: query,
                },
                dataType: 'json',
                success: function(data) {
                    $('#searchResults').empty();

                    if (Array.isArray(data) && data.length > 0) {
                        $('#searchResults').empty();
                        $.each(data, function(index, item) {
                            var count = item.count ? item.count :
                                "--";
                            var salary = item.salary ? item.salary :
                                "--";

                            $('#searchResults').append(
                                '<li class="list-group-item">' +
                                item.name +
                                ' - Employees: ' + count +
                                ', Total Salary: ' + salary +
                                '</li>'
                            );
                        });
                    } else {
                        $('#searchResults').html(
                            '<li class="list-group-item">No results found</li>'
                        );
                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#searchResults').empty();
        }
    });
</script>


<?php include 'includes/footer.blade.php'; ?>
