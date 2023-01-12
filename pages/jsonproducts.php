<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARThusen</title>
</head>
<body>

<?php
require_once __DIR__ . "/../classes/Template.php";

Template::header("Produkter");
?>


<h1>Arthusen_ </h1>
    <div class="grid-container"></div>
    

<script>
        /* https://www.youtube.com/watch?v=zUcc4vW-jsI */
        //fetchat api me products
        fetch('../products.json')
            .then(res => {
                return res.json();
            })
            .then(jsondata => {
                jsondata.forEach(product => {
                    const productCard = `
                <div class="grid-card">
                        <h2>${product.productName}</h2>
                        <h4 class="h4-pad">${product.productPrice} :-</h4>
                        <h4> I lager: ${product.productQtn}</h4>
                        <img src="${product.productImg}" class="img">
                        <input class="box-btn" type="button" value="Lägg till i varukorg">
            </div>`
                    document.querySelector('.grid-container').insertAdjacentHTML('beforeend', productCard);
                });
            })
            .catch(error => console.log(error));
    </script>


<!--         <form action="/scripts/post-add-to-cart.php" method="post">
            <input type="hidden" name="product-id" value="<?= $product->id ?>">
            <input type="submit" value="Add to cart">
        </form> -->


        <?php

Template::footer();
    ?>


</body>
</html>