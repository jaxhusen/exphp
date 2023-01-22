<?php
require_once __DIR__ . "/Db.php";
require_once __DIR__ . "/Msg.php";



class MsgDb extends Db{

    public function send_message(Msg $msg){
        $query = "INSERT INTO `msg-user` (username, `message`, reply) VALUES (?,?,?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("sss", $msg->username, $msg->message, $msg->reply);
        $success = $stmt->execute();
        return $success;
    }

    public function reply_message( $id, $reply){
        $query = "UPDATE `msg-user`  SET `reply` = ? WHERE `msg-user` . `id` = ?";     
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("si", $reply, $id);
        $success = $stmt->execute();
        return $success;
    }

    public function get_all()
    {
        $query = "SELECT * FROM `msg-user` ";
        $result = mysqli_query($this->conn, $query);
        $db_messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $messages =  [];
        var_dump($db_messages);
        
        foreach ($db_messages as $db_message) {
            $db_id = $db_message["id"];
            $db_username = $db_message["username"];
            $db_message = $db_message["message"];
          
            $messages[] = new Msg($db_username, $db_message, $db_id, $db_reply);
        }
        return $messages;
    }
}