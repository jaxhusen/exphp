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


<h2> Om oss: </h2>
    <div>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        Adipisci at fuga nulla non ea optio maxime quo autem laboriosam
        magnam praesentium ab possimus nemo velit, corporis ipsum quis neque eum?
</div><br>

    <div>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        Adipisci at fuga nulla non ea optio maxime quo autem laboriosam
        magnam praesentium ab possimus nemo velit, corporis ipsum quis neque eum?
</div><br>

    <div>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        Adipisci at fuga nulla non ea optio maxime quo autem laboriosam
        magnam praesentium ab possimus nemo velit, corporis ipsum quis neque eum?
</div><br>

    <div>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        Adipisci at fuga nulla non ea optio maxime quo autem laboriosam
        magnam praesentium ab possimus nemo velit, corporis ipsum quis neque eum?
</div><br>

    <div>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        Adipisci at fuga nulla non ea optio maxime quo autem laboriosam
        magnam praesentium ab possimus nemo velit, corporis ipsum quis neque eum?
</div><br>



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
                        <img class="img" src="/assets/uploads/corre.jpg" alt="Corona">
                        <input class="box-btn" type="button" value="Lägg till i varukorg">
            </div>`
                    document.querySelector('.grid-container').insertAdjacentHTML('beforeend', productCard);
                });
            })
            .catch(error => console.log(error));
    </script>


</body>
</html>

<?php

Template::footer();