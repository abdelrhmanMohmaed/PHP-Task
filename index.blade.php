<?php
include 'includes/header.blade.php';
include 'includes/alerts/success.blade.php';
include 'includes/alerts/errors.blade.php';
include 'includes/Models/Employees/create.blade.php';
include 'includes/Models/Employees/search.blade.php';
?>


<div class="container mt-5">
    <div class="border rounded p-5 bg-light bg-gradient">

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

            <div class="col-md-2">
                <img class="rounded-circle" src="assets/img/avaters/<?= @$session->get('avatar') ?>" alt="avater"
                    height="110" width="110">
            </div>

            <div class="col-md-5 pt-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" disabled
                    value="<?= $session->get('first_name') ?>">
            </div>

            <div class="col-md-5 pt-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" disabled
                    value="<?= $session->get('last_name') ?>">
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" disabled
                    value="<?= $session->get('email') ?>">
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" disabled
                    value="<?= $session->get('phone') ?>">
            </div>

            <div class="col-12">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" id="salary" min="0" disabled
                    value="<?= $session->get('salary') ?>">
            </div>

            <div class="col-md-6 col-12">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" disabled
                    value="<?= @$session->get('department_name') ?>">
            </div>

            <div class="col-md-6">
                <label for="manager" class="form-label">His Manager</label>
                <input type="text" class="form-control" id="manager" disabled
                    value="<?= htmlspecialchars($displayValue) ?>">
            </div>

            <div class="col-12">
                <a href="<?= URL ?>update-profile.blade.php" class="btn btn-warning float-end">Edit</a>
            </div>

            <?php if (empty($managerName)) : ?>
            <h3>Team Members</h3>
            <?php if (!empty($teamMembers)) : ?>
            <ul>
                <?php foreach ($teamMembers as $member) : ?>
                <li>
                    Name:
                    <?= htmlspecialchars($member['first_name']) . ' ' . htmlspecialchars($member['last_name']) ?><br>
                    Email: <?= htmlspecialchars($member['email']) ?><br>
                    Phone: <?= htmlspecialchars($member['phone']) ?><br>
                    <a href="<?= URL . 'update-employee.blade.php?id=' . htmlspecialchars($member['id']) ?>"
                        class="text-warning">
                        Edit
                    </a>
                    &nbsp;
                    <a href="<?= URL . 'Handler/handler-delete-employee.php?id=' . htmlspecialchars($member['id']) ?>"
                        class="text-danger" onclick="return confirm('Are you sure you want to delete this employee?');">
                        Delete
                    </a>
                    <hr>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else : ?>
            <p>No team members found.</p>
            <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var query = $(this).val();

            // console.log('Query:', query); 

            if (query.length > 0) {
                $.ajax({
                    url: 'Handler/handler-search-employee.php',
                    type: 'GET',
                    data: {
                        first_name: query,
                        last_name: query
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#searchResults').empty();

                        if (Array.isArray(data) && data.length > 0) {
                            $.each(data, function(index, item) {
                                $('#searchResults').append(
                                    '<li class="list-group-item">' + item
                                    .first_name + ' ' + item.last_name + '</li>'
                                );
                            });
                        } else {
                            $('#searchResults').html(
                                '<li class="list-group-item">No results found</li>');
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
    });
</script>


<?php include 'includes/footer.blade.php'; ?>
