<?php
session_start();

if (!isset($_SESSION['isLoggedIn'])) {
    header('location: index.php');
    return;
}

$pageTitle = 'View Book';

require_once('database.php');
$id = $_GET['id'];
$query = 'SELECT * FROM books WHERE id = :id';
$statement = $connection->prepare($query);
$statement->bindParam('id', $id, PDO::PARAM_INT);
$statement->execute();
$book = $statement->fetch(PDO::FETCH_OBJ);
$connection = null;

if (!$book) {
    header('location: books.php');
    return;
}

?>

<?php require_once('includes/header.php'); ?>
<?php require_once('includes/styles.php'); ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2><?= $pageTitle; ?></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $book->book_name; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" value="<?= $book->book_author; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="year_published" class="form-label">Year Published</label>
                            <input type="number" class="form-control" id="year_published" name="year_published" value="<?= $book->year_published; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price (₱)</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= $book->price; ?>" readonly>
                        </div>
                        <a href="books.php" class="text-danger">Go back</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('includes/scripts.php'); ?>
<?php require_once('includes/footer.php'); ?>