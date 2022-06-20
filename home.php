<?php

require_once 'connect.php';
$pdo = connect();

$stmt = $pdo->prepare('SELECT * FROM products ORDER BY id');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <?=_header('Home')?>
    <div>
        <h2>Ultimi Prodotti</h2>
        <div class="products">
            <?php foreach ($recently_added_products as $product): ?>
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['name']?></h5>
                        <p class="price"><?=$product['price']?>€</p>
                        <a href="index.php?page=product&id=<?=$product['id']?>" class="btn btn-primary">Dettagli Prodotto</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?=_footer()?>
</body>
</html>