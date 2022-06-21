<?php
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('Product does not exist!');
    }
} else {
    exit('Product does not exist!');
}
?>
<?=_header('Prodotto')?>
<body>
    <div>
        <div>
            <h1 class="name"><?=$product['name']?></h1>
            <p class="price">
                <?=$product['price']?>€
            </p>
            <form action="index.php?page=cart" method="post">
                <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity'] ?>" placeholder="Quantity" required> 
                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                <input type="submit" value="Aggiungi al Carrello">
            </form>
        </div>
    </div>
    <?=_footer()?>
</body>
</html>