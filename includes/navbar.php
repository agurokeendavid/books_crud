<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Book Encoding System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['isLoggedIn'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($pageTitle === 'List of Encoded Books' || $pageTitle === 'View Book') ? 'active' : null;  ?>" aria-current="page" href="books.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($pageTitle === 'Create a Book') ? 'active' : null;  ?>" aria-current="page" href="create.php">Create a book</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['name']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarAccount">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($pageTitle === 'Login') ? 'active' : null;  ?>" aria-current="page" href="index.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($pageTitle === 'Register') ? 'active' : null;  ?>" aria-current="page" href="register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>