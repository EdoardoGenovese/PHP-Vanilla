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
<?=_header('Prodotti')?>
<body>
    <div>
        <h1 class="container">Prodotti</h1>
        <p class="container"><?=$total_products?> Prodotti trovati</p>
        <div class="products-wrapper d-flex justify-content-around mt-3 mb-3">
            <?php foreach ($products as $product): ?>
                <div class="card" style="width: 18rem;">
                    <img src="img/<?=$product['image']?>" class="card-img-top" alt="<?=$product['name']?>">
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