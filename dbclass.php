<?php

// ---------------------------------------------------------------------------------
// SAMPLE API - by Casey Blamires (https://www.github.com/clblamires/sample-php-api)
// ---------------------------------------------------------------------------------

// This file is used to connect to the MySQL database
// fill in the appropriate data in the DBClass

// check API key first
// you might store this API key in a database and draw from that, instead of hardcoding it here
$key = isset($_GET['key']) && $_GET['key'] = "c903f90d6078bd641d5eca794deb1d99" ? true : false;
if( !$key ) {
    http_response_code(404);
    die();
}

// DBClass - defines an instance of connecting to MySQL
class DBClass {
    // set your variables here!
    private $host = "localhost";
    private $user = "root";
    private $pass = "root";
    private $db   = ""; // fill in the blank here!

    public $connection;

    // create the connection
    public function getConnection(){
        $this->connection = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=utf8";
            $this->connection = new PDO($dsn , $this->user, $this->pass );
        } catch( PDOException $e){
            // whoops, something screwed up
            echo "Error: " . $e->getMessage();
            die();
        }

        return $this->connection;
    }

    // destructor, clear out the connection
    function __destruct(){
        $this->connection = null;
    }


}