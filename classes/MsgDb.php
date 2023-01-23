<?php
require_once __DIR__ . "/Db.php";
require_once __DIR__ . "/Msg.php";
require_once __DIR__ . "/User.php";



class MsgDb extends Db{
    public function send_message(Msg $msg){
        $query = "INSERT INTO `msg-user` (username, `message`, `status`) VALUES (?,?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("sss", $msg->username, $msg->message, $msg->status);
        $success = $stmt->execute();
        return $success;
    }

    public function get_all_msg()
    {
        $query = "SELECT * FROM `msg-user` ";
        $result = mysqli_query($this->conn, $query);
        $db_messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $messages =  [];
        /* var_dump($db_messages); */
        
        foreach ($db_messages as $db_message) {
            $messages[] = new Msg(
                $db_message["username"],
                $db_message["message"],
                $db_message["status"],
                $db_message["id"]
            );
        }
        return $messages;
    }

        //delete
        public function delete($id)
        {
            $query = "DELETE FROM `msg-user` WHERE id = ?";
            $stmt = mysqli_prepare($this->conn, $query);
            $stmt->bind_param("i", $id);
            $success = $stmt->execute();
    
            return $success;
        }

        //update status
public function update_message_status($id, $status)
{
    $query = "UPDATE `msg-user` SET `status` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($this->conn, $query);
    $stmt->bind_param("si", $status, $id);
    $success = $stmt->execute();

    return $success;
}
}