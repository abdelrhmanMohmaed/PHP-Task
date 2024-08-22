<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="Handler/handler-update-task.php">
                    <input type="hidden" id="taskId" name="id">

                    <div class="mb-3">
                        <label for="status" class="form-label">Task Status</label>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option value="">Open this select menu</option>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary float-end">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
