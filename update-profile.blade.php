<?php include 'includes/header.blade.php'; ?>


<div class="container mt-5 d-flex justify-content-center ">
    <div class="border rounded p-5 bg-light bg-gradient col-md-6 md-6">

        <?php include PATH . 'includes/alerts/errors.blade.php'; ?>

        <form class="row g-3" method="post" action="<?= URL ?>Handler/handler-profile.php" enctype="multipart/form-data">

            <div class="col-md-2">
                <img class="rounded-circle" src="assets/img/avaters/<?= @$session->get('avatar') ?>" alt="avatar"
                    height="110" width="110">
            </div>

            <div class="col-md-12">
                <label for="first_name" class="form-label">First Name</label>
                <input required type="text" name="first_name" class="form-control" id="first_name"
                    value="<?= $session->get('first_name') ?>">
            </div>

            <div class="col-md-12">
                <label for="last_name" class="form-label">Last Name</label>
                <input required type="text" name="last_name" class="form-control" id="last_name"
                    value="<?= $session->get('last_name') ?>">
            </div>

            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input required type="email" name="email" class="form-control" id="email"
                    value="<?= $session->get('email') ?>">
            </div>

            <div class="col-md-12">
                <label for="phone" class="form-label">Phone</label>
                <input required type="tel" name="phone" class="form-control" id="phone"
                    value="<?= $session->get('phone') ?>">
            </div>

            <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input required type="password" name="password" class="form-control" id="password"
                    placeholder="Password" autocomplete="current-password">
            </div>

            <div class="col-md-12">
                <label for="confrim_password" class="form-label">Confrim Password</label>
                <input required type="password" name="comfirm_password" class="form-control" id="phone"
                    autocomplete="current-password">
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
