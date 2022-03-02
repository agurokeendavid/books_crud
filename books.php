<?php
session_start();

if (!isset($_SESSION['isLoggedIn'])) {
    header('location: index.php');
    return;
}

$pageTitle = 'List of Encoded Books';

require_once('database.php');
$query = 'SELECT * FROM books;';
$statement = $connection->prepare($query);

$statement->execute();

$books = $statement->fetchAll(PDO::FETCH_OBJ);

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
                    <div class="table-responsive">
                        <table id="booksTable" class="table table-bordered cell-border">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Year Published</th>
                                    <th>Price</th>
                                    <th>Date Encoded</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($books as $book) : ?>
                                    <tr>
                                        <td><?= $book->id; ?></td>
                                        <td><?= $book->book_name; ?></td>
                                        <td><?= $book->book_author; ?></td>
                                        <td><?= $book->year_published; ?></td>
                                        <td><?= '₱' . $book->price; ?></td>
                                        <td><?= $book->date_created; ?></td>
                                        <td>
                                            <a href="view.php?id=<?= $book->id; ?>" class="btn btn-primary">View</a>
                                            <a href="edit.php?id=<?= $book->id; ?>" class="btn btn-info">Edit</a>
                                            <a href="delete.php?id=<?= $book->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Year Published</th>
                                    <th>Price</th>
                                    <th>Date Encoded</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('scripts.php'); ?>
<script src="assets/js/custom.js"></script>

<?php require_once('footer.php'); ?>