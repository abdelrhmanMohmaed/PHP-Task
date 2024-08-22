<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Model</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" method="post" action="<?= URL ?>Handler/handler-create-department.php">
                <div>
                    <label for="department" class="form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="department"
                        placeholder="Ex: HR Department" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary my-2 float-end">Save</button>
            </form>
        </div>
    </div>
</div>
