<?php

function connect() {
    $db = "progetto2";
    $hostname = "localhost:3306";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO(
            "mysql:host=$hostname;dbname=$db",
            $username,
            $password
        );
    } catch(Exception $e) {
        echo "Errore!";
        var_dump($e);
    }

    return $pdo;
}

function _header($title) {
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>$title</title>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        </head>
        <body>
            <header>
                <nav class="navbar navbar-expand-lg bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php?page=home">PHP Project</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?page=products">Prodotti</a>
                            </li>
                            </ul>
                            <a class="m-3" href="index.php?page=cart">
                                <i class="fas fa-shopping-cart"><span>$num_items_in_cart</span></i>
                            </a>
                            <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Cerca un prodotto..." aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Cerca</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </header>
            <main>
    EOT;
    }
    function _footer() {
    $year = date('Y');
    echo <<<EOT
            </main>
            <footer>
                <hr class="m-6">
                <div>
                    <p>&copy; $year, PHP Project</p>
                </div>
            </footer>
        </body>
    </html>
    EOT;
    }
    ?>

