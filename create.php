<?php
session_start();

if (!isset($_SESSION['isLoggedIn'])) {
    header('location: index.php');
    return;
}

$pageTitle = 'Create a Book';

if ($_POST) {
    require_once('database.php');
    $name = $_POST['name'];
    $author = $_POST['author'];
    $year_published = $_POST['year_published'];
    $price = $_POST['price'];

    $query = 'INSERT INTO books (book_name, book_author, year_published, price) VALUES (:book_name, :book_author, :year_published, :price)';
    $statement = $connection->prepare($query);
    $statement->bindParam('book_name', $name, PDO::PARAM_STR);
    $statement->bindParam('book_author', $author, PDO::PARAM_STR);
    $statement->bindParam('year_published', $year_published, PDO::PARAM_INT);
    $statement->bindParam('price', $price, PDO::PARAM_INT);
    if ($statement->execute()) {
        $message = 'Book record has been successfully inserted.';
    }
}
?>

<?php require_once('header.php'); ?>
<?php require_once('styles.php'); ?>
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
                            <input type="text" class="form-control" id="name" name="name" placeholder="Please input book title" required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" placeholder="Please input book author format (Lastname, Firstname M.I)" required>
                        </div>
                        <div class="mb-3">
                            <label for="year_published" class="form-label">Year Published</label>
                            <input type="number" class="form-control" id="year_published" name="year_published" placeholder="Please input year published" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price (₱)</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Please input price" required>
                        </div>
                        <a href="books.php" class="text-danger">Go back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('scripts.php'); ?>
<?php require_once('footer.php'); ?>