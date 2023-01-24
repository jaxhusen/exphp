<?php
require_once __DIR__ . "/Db.php";
require_once __DIR__ . "/Order.php";
/* Läser in databas- filen
+ order filen för att kunna använda den*/

class OrdersDb extends Db{
    //function för att hämta en order från order-products och kopplas ihop med order-users för att få fram rätt info
    public function get_one_by_userid($user_id){
        $query = "SELECT op.id, op.`order-id`, os.`user-id`, os.`order-date`, os.`status` 
        FROM `order-products` AS op
        JOIN `order-users` AS os ON op.`order-id` = os.id 
        JOIN users AS u ON os.`user-id` = u.id
        WHERE os.`user-id` = ?/* 
        group by  op.`order-id` */";

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
                $db_order["order-id"]
            );
            $orders[] = $order;
        }
        return $orders;
    }


    //kod för functionen hämta alla orders från table order-users
    public function get_all(){
    $query = "SELECT * FROM `order-users`";
    $stmt = mysqli_prepare($this->conn, $query);
    $stmt->execute();
    $result = $stmt->get_result();
    $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $orders = [];

    foreach ($db_orders as $db_order) {
        $orders[] = new Order(
            $db_order["user-id"],
            $db_order["status"],
            $db_order["order-date"],
            $db_order["id"]
        );
    }
    return $orders;
    }


    //U i crud för nya orders som läggs i table order-users
    public function create(Order $order)
    {
        $query = "INSERT INTO `order-users` (`user-id`, `status`, `order-date`) VALUES (?,?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("iss", $order->user_id, $order->status, $order->order_date);
        $success = $stmt->execute();
        if ($success) {
            return $stmt->insert_id;
        }
        return false;
    }

    //U i crud för nya orders som läggs i table kopplingtabellen order-products
    public function create_order($order_id, $product_id)
    {
        $query = "INSERT INTO `order-products` (`order-id`, `product-id`) VALUES (?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ii", $order_id, $product_id);
        $success = $stmt->execute();

        return $success;
    }


    //update status via id och status i table order-users
    public function update_order_status($id, $status)
    {
        $query = "UPDATE `order-users` SET `status` = ? WHERE `id` = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("si", $status, $id);
        $success = $stmt->execute();

        return $success;
    }


    // kod till funktion för att radera order via id i table `order-users`
    public function delete($id)
    {
        $query = "DELETE FROM `order-users` WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();

        return $success;
    }


}