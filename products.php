<?php

require_once 'connect.php';
$pdo = connect();

$num_products_on_each_page = 4;

$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

$stmt = $pdo->prepare('SELECT * FROM products');
$stmt ->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_products = $pdo->query('SELECT * FROM products')->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?=_header('Prodotti')?>
    <div>
        <h1>Prodotti</h1>
        <p><?=$total_products?> Prodotti Totali</p>
        <div class="products-wrapper">
            <?php foreach ($products as $product): ?>
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['name']?></h5>
                        <p class="price"><?=$product['price']?>€</p>
                        <a href="index.php?page=product&id=<?=$product['id']?>" class="btn btn-primary">Dettagli prodotto</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div>
            <?php if ($current_page > 1): ?>
            <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
            <?php endif; ?>
            <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
            <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
    <?=_footer()?>
</body>
</html>