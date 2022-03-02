<?php
$pageTitle = 'Register';
if ($_POST) {
    try {
        require_once('database.php');
        $name = $_POST['name'];
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $query = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
        $statement = $connection->prepare($query);
        $statement->bindParam('name', $name, PDO::PARAM_STR);
        $statement->bindParam('email', $email_address, PDO::PARAM_STR);
        $statement->bindParam('password', $encrypted_password, PDO::PARAM_STR);

        if ($statement->execute()) {
            $message = 'User successfully created.';
        }
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
                    <h2 class="text-center"><?= $pageTitle; ?></h2>
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
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Please input your name format (Lastname, Firstname M.I)" required>
                        </div>
                        <div class="mb-3">
                            <label for="email_address" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Please input your email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Please input your password" required>
                        </div>
                        <div class="mb-3">
                            Already have an account? <a href="index.php">Login</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('scripts.php'); ?>
<?php require_once('footer.php'); ?>