<?php

use PHP_Task\Classes\Models\User;
$use = new User();

$managerId = $session->get('id');
$users = $use->selectWhere("manager_id = $managerId");

?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Model</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" method="post" action="<?= URL ?>Handler/handler-create-task.php"
                enctype="multipart/form-data">
                <div class="row">

                    <div class="col-12">
                        <label for="user" class="form-label">Assign to </label>
                        <select class="form-select" name="user" aria-label="Default select example">
                            <option disabled selected>Open this select menu</option>
                            <?php foreach ($users as $item): ?>
                            <option value="<?= htmlspecialchars($item['id']) ?>">
                                <?= htmlspecialchars($item['first_name']) ." " .htmlspecialchars($item['last_name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Ex: PHP-Task" required>
                    </div>

                    <div class="col-md-12 my-2">
                        <label for="title" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10" required
                            placeholder="Description of task"></textarea>
                    </div>

                </div>

                <button type="submit" name="submit" class="btn btn-primary my-2 float-end">Save</button>
            </form>
        </div>
    </div>
</div>
