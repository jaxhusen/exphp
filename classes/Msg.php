<?php 

Class Msg {
    public $id;
    public $username;
    public $message;
    public $reply;


    public function __construct($username, $message, $id=0, $reply = "")
    {
        if($id > 0){
            $this->id = $id;
        }
        $this->username = $username;
        $this->message = $message;
        $this->reply = $reply;
    }
}