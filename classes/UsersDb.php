<?php

require_once __DIR__ . "/Db.php";
require_once __DIR__ . "/User.php";


class UsersDb extends Db{

    //get_one
    public function get_one_by_username($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_user = mysqli_fetch_assoc($result);
        $user = null;

        if ($db_user) {
            $user = new User($db_user["username"], $db_user["role"], $db_user["id"]);
            $user->set_password_hash($db_user["password-hash"]);
        }
        return $user;
    }


    //get_all
    public function get_all()
    {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $query);
        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $users = [];

        foreach ($db_users as $db_user) {
            $db_id = $db_user["id"];
            $db_username = $db_user["username"];
            $db_role = $db_user["role"];

            $user = new User($db_username, $db_role, $db_id);
            $user->set_password_hash($db_user["password-hash"]);

            $users[] = $user;
        }
        return $users;
    }


    //create
    public function create(User $user){
        $query = "INSERT INTO users (username, `password-hash`, `role`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("sss", $user->username, $user->get_password_hash(), $user->role);
        $success = $stmt->execute();

        return $success;
    }


    // update role
    public function update(User $user){
        $query = "UPDATE users SET `role` = ? WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ss", $user->role, $user->username);
        return $stmt->execute();
    }


    // delete
    public function delete($username){
        $query = "DELETE FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("s", $username);

        return $stmt->execute();
    }


       //skapa funktionen för google  get_google_user_id
   public function get_google_userid(User $user)
   {
       $db_user = $this->get_one_by_username($user->username);
       if ($db_user == null) {
           $query = "INSERT INTO users (username, `role`) VALUES (?,?)";
           $stmt = mysqli_prepare($this->conn, $query);
           $username = $user->username;
           $stmt->bind_param("ss", $username, $username->role);
           $success = $stmt->execute();
           if ($success) {
               $user->id = $stmt->insert_id;
           } else {
               die("Failed to save google user: " . $stmt->error);
           }
       } else {
           $user = $db_user;
       }
       return $user->id;
   }
}