<?php

class DB {
    private $servername;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "pesoplumadb";
    }

    function conectarDB() {
        try {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
    
            return $conn;
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}

?>