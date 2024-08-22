<?php require_once 'app.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Task</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5 d-flex justify-content-center pt-5">
        <div class="border rounded p-5 bg-light bg-gradient row col-md-6 col-6">
            <div class="text-center my-3">
                <h1>Login</h1>
            </div>
            <?php include PATH . 'includes/alerts/errors.blade.php'; ?>
            <form method="post" action="<?= URL ?>Handler/handler-login.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email or Phone</label>
                    <input type="text" name="authenticator" class="form-control" id="email">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>

                <div class="text-center mt-5 col-md-12 w-100">
                    <button type="submit" name="submit" class="btn btn-primary w-100">Sigin</button>
                </div>
            </form>
        </div>
    </div>


    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
