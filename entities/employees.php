<?php

// ---------------------------------------------------------------------------------
// SAMPLE API - by Casey Blamires (https://www.github.com/clblamires/sample-php-api)
// ---------------------------------------------------------------------------------

// Employee entity
// represents an employee for a company
class Employee {
    private $connection;

    // if you're using this for your own work, feel free to change this to whatever table you're using
    private $table_name = "employees";

    // columns
    public $employee_id;
    public $firstname;
    public $lastname;
    public $password;
    public $archive;

    // constructor
    public function __construct($connection){
        $this->connection = $connection;
    }



    // ---------------------------------------------------------------------------------
    // CRUD Functions
    // ---------------------------------------------------------------------------------

    // create - used for adding new data to the table
    // returns the last ID inserted (assuming your table has a primary key)
    public function create(){
        $query = "INSERT INTO " . $this->table_name . " VALUES (NULL, :firstname, :lastname, :password, :archive)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":firstname", $this->firstname );
        $stmt->bindParam(":lastname", $this->lastname );
        $stmt->bindParam(":password", $this->password );
        $stmt->bindParam(":archive", $this->archive );
        $stmt->execute();

        return $this->connection->lastInsertId();
    }

    // read - gets data from the table
    // returns a PDO statement
    public function read( $id = 0 ){
        if( $id != 0 ){
            $query = "SELECT * FROM " . $this->table_name . " WHERE `employee_id` = :id LIMIT 1";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":id", $id );
        } else {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->connection->prepare($query);
        }
        $stmt->execute();
        return $stmt;
    }

    // update - edits information in the table
    // I should probably finish this one...
    public function update(){

    }

    // delete - removes data from the table
    // returns the number of rows affected by the query
    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE `employee_id` = :id LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $this->employee_id);
        $stmt->execute();

        return $stmt->rowCount();
    }
}