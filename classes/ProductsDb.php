<?php
require_once __DIR__ . "/Db.php";
require_once __DIR__ . "/Product.php";

class ProductsDb extends Db
{
    //get_one
    public function get_one($id)
    {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_product = mysqli_fetch_assoc($result);
        $product = null;

        if ($db_product) {
            $product = new Product(
                $db_product["title"],
                $db_product["price"],
                $db_product["img-url"],
                $id
            );
        }
        return $product;
    }

    //get_all
    public function get_all()
    {
        $query = "SELECT * FROM products";
        $result = mysqli_query($this->conn,  $query);
        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $products = [];

        foreach ($db_products as $db_product) {
            $db_id = $db_product["id"];
            $db_title = $db_product["title"];
            $db_price = $db_product["price"];
            $db_img_url = $db_product["img-url"];

            $products[] = new Product($db_title, $db_price, $db_img_url, $db_id);
        }
        return $products;
    }

    //create
    public function create(Product $product)
    {
        $query = "INSERT INTO products (title, price, `img-url`) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ssis", $product->title, $product->price, $product->img_url);
        $success = $stmt->execute();

        return $success;
    }


    //update
    public function update(Product $product, $id)
    {
        $query = "UPDATE products SET title=?, price=?, `img-url`=? WHERE id=?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param(
            "ssisi",
            $product->title,
            $product->price,
            $product->img_url,
            $id
        );
        return $stmt->execute();
    }



    //delete
    public function delete($id)
    {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }


    public function get_by_orderid($order_id)
    {
        $query = "SELECT op.id,
            op.`order-id`,
            u.username,
            p.`title`,
            p.price,
            p.`img-url`,
            os.`user-id`,
            os.`order-date`,
            os.`status`
            FROM `order-products` AS op
        JOIN `order-users` AS os ON op.`order-id` = o.id
        JOIN users AS u ON os.`user-id` = u.id
        JOIN products AS p ON op.`product-id` = p.id
        WHERE op.`order-id` = ?";



        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $products = [];

        foreach ($db_products as $db_product) {
            $product = new Product(
                $db_product["title"],
                $db_product["price"],
                $db_product["img-url"],
            );
            $products[] = $product;
        }
        return $products;
    }
}