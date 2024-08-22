<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Model</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" method="post" action="<?= URL ?>Handler/handler-create-employee.php"
                enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            placeholder="Ex: Ahmed" required>
                    </div>

                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            placeholder="Ex: Mohamed" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="EX: ahmed@hotmail.com" required>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone"
                            placeholder="Ex: 01125843976" required>
                    </div>

                    <div class="col-md-6">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="number" class="form-control" id="salary" name="salary" min="0"
                            step="0.01" placeholder="5820.25" required>
                    </div>

                    <div class="col-md-6">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" name="avatar" class="form-control" id="avatar" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input required type="password" name="password" class="form-control" id="password"
                            placeholder="Password" autocomplete="current-password" required>
                        <small class="form-text text-muted">
                            Contain uppercase, lowercase, numbers, and symbols.
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label for="confrim_password" class="form-label">Confrim Password</label>
                        <input required type="password" name="confirm_password" class="form-control" id="phone"
                            autocomplete="current-password" required>
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

                </div>

                <button type="submit" name="submit" class="btn btn-primary my-2 float-end">Save</button>
            </form>
        </div>
    </div>
</div>
