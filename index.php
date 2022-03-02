<?php
$pageTitle = 'Login';
session_start();

if (isset($_SESSION['isLoggedIn'])) {
    header('location: books.php');
    return;
}

if ($_POST) {
    require_once('database.php');

    try {
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];

        $query = 'SELECT * FROM users WHERE email = :email';
        $statement = $connection->prepare($query);
        $statement->bindParam('email', $email_address, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_OBJ);

        if ($statement->rowCount() > 0 && password_verify($password, $user->password)) {
            $_SESSION['name'] = $user->name;
            $_SESSION['isLoggedIn'] = true;
            header('location: books.php');
            return;
        }

        $message = 'Invalid email address/password.';
    } catch (Exception $exception) {
        $message = $exception->getMessage();
    }
}


?>
<?php require_once('header.php'); ?>
<?php require_once('styles.php'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-sm-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h2 class="text-center">Login</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email_address" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Please input your email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Please input your password" required>
                        </div>
                        <div class="mb-3">
                            Don't have an account? <a href="register.php">Register</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('scripts.php'); ?>
<?php require_once('footer.php'); ?>