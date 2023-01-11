<?php

require_once __DIR__ . "/Database.php";

require_once __DIR__ . "/Order.php";



class OrdersDatabase extends Database{

//get_one

 public function get_one_by_userid($user_id){

    {
        $query = "SELECT * FROM orders WHERE `user-id` = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $orders = [];

        foreach ((array)$db_orders as $db_order) {
            $order = new Order(
                $db_order["user-id"],
                $db_order["status"],
                $db_order["order-date"],
                //$db_order["order-id"]
            );
            $orders[] = $order;
        }
        return $orders;
    }
}





//get_all
public function get_all(){
    $query = "SELECT * FROM orders";
    $result = mysqli_query($this->conn, $query);
    $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $orders = [];



    foreach ($db_orders as $db_order){
        $db_id = $db_order["id"];
        $db_status = $db_order["status"];
        $db_order_date = $db_order["order-date"];

        $orders[] = new Order($db_id, $db_status, $db_order_date);
    }
    return $orders;
}

    //create
    public function create(Order $order)
    {
        $query = "INSERT INTO orders (`user-id`, `status`, `order-date`) VALUES (?,?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("iss", $order->user_id, $order->status, $order->order_date);
        $success = $stmt->execute();

        if ($success) {
            return $stmt->insert_id;
        }
        return false;
    }



    public function create_order($order_id, $product_id)
    {
        $query = "INSERT INTO `order-products` (`order-id`, `product-id`) VALUES (?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ii", $order_id, $product_id);
        $success = $stmt->execute();

        return $success;
    }





    public function update_order_status($id, $status)
    {
        $query = "UPDATE `orders` SET `status` = ? WHERE `orders`.`id` = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("si", $status, $id);
        $success = $stmt->execute();

        return $success;
    }



    //delete
    public function delete($id)
    {
        $query = "DELETE FROM orders WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();

        return $success;
    }



}