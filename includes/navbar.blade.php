<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?= URL ?>index.blade.php">Navbar</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URL ?>index.blade.php">Home</a>
                </li>

                <?php if (empty($managerName)) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>department.blade.php">Department</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>task.blade.php">Tasks</a>
                </li>
            </ul>

            <form class="d-flex" method="post" action="<?= URL ?>Handler/handler-logout.php">
                <button class="btn btn-dark text-white" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>
