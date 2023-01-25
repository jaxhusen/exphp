<!-- läser in basic info via Template coh hämtar products.json via fetch och loopar igenom resultatet som går att hitta på fliken REA-->
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
Template::header("");
?>


    <div class="grid-container"></div>
<script>
        //fetchat api me products.json
        fetch('../products.json')
            .then(res => {
                return res.json();
            })
            .then(jsondata => {
                jsondata.forEach(product => {
                    const productCard = `
                    <div class="grid-card">
                        <h2>${product.productName}</h2>
                        <div class="admin-box-right">
                            <h4 class="h4-pad" style="text-decoration: line-through">${product.productPrice} :-</h4>
                            <h4 style="color: red; padding-left:5%; padding-top: 3%; font-size: larger;"> ${product.productSale} :-</h4>
                        </div>
                        <div class="zoom-img-container">
                            <img src="${product.productImg}" alt="Bild" class="img zoom-img">
                        </div>
                        <input type="hidden" name="product-id" value="<?= $product->id ?>">
                        <input class="box-btn add" type="submit" value="Lägg till i varukorg">
                        </div>`
                    document.querySelector('.grid-container').insertAdjacentHTML('beforeend', productCard);
                });
            })
            
            .catch(error => console.log(error));
    </script> 
        <?php

Template::footer();
    ?>


</body>
</html>