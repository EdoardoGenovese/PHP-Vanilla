<?php

require_once 'connect.php';
$pdo = connect();

$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=_header('Home')?>
<body>
    <div>
        <h2 class="container">Ultimi Prodotti</h2>
        <div class="d-flex justify-content-around mt-3 mb-3">
            <?php foreach ($recently_added_products as $product): ?>
                <div class="card" style="width: 18rem;">
                    <img src="img/<?=$product['image']?>" class="card-img-top" alt="<?=$product['name']?>">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['name']?></h5>
                        <p class="price"><?=$product['price']?>€</p>
                        <?php if ($product['sale'] > 0): ?>
                        <span><?=$product['sale']?>€</span>
                        <?php endif; ?>
                        <a href="index.php?page=product&id=<?=$product['id']?>" class="btn btn-primary">Dettagli Prodotto</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?=_footer()?>
</body>
</html>