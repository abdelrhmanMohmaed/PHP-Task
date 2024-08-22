<?php include 'includes/header.blade.php'; ?>

<?php
use PHP_Task\Classes\Models\User;

if ($request->getHas('id') && empty($managerName)) {
    $id = $request->get('id');
} else {
    $request->redirect('index.blade.php');
}

$user = new User();
$employee = $user->selectId($id);
?>



<div class="container mt-5 d-flex justify-content-center ">
    <div class="border rounded p-5 bg-light bg-gradient col-md-6 md-6">

        <?php include PATH . 'includes/alerts/errors.blade.php'; ?>

        <form class="row g-3" method="post"
            action="<?= URL . 'Handler/handler-update-employee.php?id=' . $employee['id'] ?>"
            enctype="multipart/form-data">

            <div class="col-md-2">
                <img class="rounded-circle" src="assets/img/avaters/<?= @$employee['avatar'] ?>" alt="avatar"
                    height="110" width="110">
            </div>

            <div class="col-md-12">
                <label for="first_name" class="form-label">First Name*</label>
                <input required type="text" name="first_name" class="form-control" id="first_name"
                    value="<?= $employee['first_name'] ?>">
            </div>

            <div class="col-md-12">
                <label for="last_name" class="form-label">Last Name*</label>
                <input required type="text" name="last_name" class="form-control" id="last_name"
                    value="<?= $employee['last_name'] ?>">
            </div>

            <div class="col-md-12">
                <label for="email" class="form-label">Email*</label>
                <input required type="email" name="email" class="form-control" id="email"
                    value="<?= $employee['email'] ?>">
            </div>

            <div class="col-md-12">
                <label for="phone" class="form-label">Phone*</label>
                <input   type="tel" name="phone" class="form-control" id="phone"
                    value="<?= $employee['phone'] ?>">
            </div>

            <div class="col-md-12">
                <label for="salary" class="form-label">Salary*</label>
                <input required type="number" step="00.01" name="salary" class="form-control" id="salary"
                    value="<?= $employee['salary'] ?>">
            </div>

            <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>

            <div class="col-md-12">
                <label for="confrim_password" class="form-label">Confrim Password</label>
                <input type="password" name="comfirm_password" class="form-control" id="confrim_password"
                    placeholder="Confrim Password">
            </div>

            <div class="col-12">
                <label for="department" class="form-label">Department</label>
                <select class="form-select" name="department" aria-label="Default select example" disabled>
                    <option>Open this select menu</option>
                    <?php foreach ($departments as $item): ?>
                    <option value="<?= htmlspecialchars($item['id']) ?>" <?php if ($item['name'] === $session->get('department_name')): ?> selected
                        <?php endif; ?>>
                        <?= htmlspecialchars($item['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-12">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="file" name="avatar" class="form-control" id="avatar">
            </div>

            <div class="col-12">
                <a href="<?= URL ?>index.blade.php" class="btn btn-primary float-end mx-1">Back</a>
                <button type="submit" name="submit" class="btn btn-warning float-end">Update</button>
            </div>

        </form>
    </div>
</div>

<?php include 'includes/footer.blade.php'; ?>
