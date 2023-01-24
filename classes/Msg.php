<?php 
/* Kopplingen för meddelande tablet i orderinfo-db */
Class Msg {
    public $id;
    public $username;
    public $message;
    public $status;


    public function __construct($username, $message, $status, $id=0,)
    {
        if($id > 0){
            $this->id = $id;
        }
        $this->username = $username;
        $this->message = $message;
        $this->status = $status;
    }
}