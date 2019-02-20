<?php

// ---------------------------------------------------------------------------------
// SAMPLE API - by Casey Blamires (https://www.github.com/clblamires/sample-php-api)
// ---------------------------------------------------------------------------------

// Employees - read
// reads all employees from the table

// setup HTTP headers to return json
header("Content-Type: application/json; charset=UTF-8");

// include necessary files
require_once("../dbclass.php");
require_once("../entities/employees.php");

// instantiate the database and get a connection
// note: this will fail if the URL 'key' parameter is nonexistent or is incorrect
$db = new DBClass();
$connection = $db->getConnection();

// ---------------------------------------------------------------------------------
// SAMPLE DATA
// ---------------------------------------------------------------------------------
$emp = new Employee($connection);

// check if an 'id' is present in the URL parameters, and if so, read only that record
// otherwise, this should read all records
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$statement = $emp->read($id);
$count = $statement->rowCount();

// we're going to store our data in an associative array with two indexes: 
// "body" (where the data will be)
// "count" (the total number of rows returned)
$employees = array();
$employees["body"] = array();
$employees["count"] = $count;


// loop through the results and create a new item in our array
if( $count > 0 ){
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $employee = array(
            "employee_id" => $employee_id,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "password" => $password,
            "archive" => $archive
        );
        // add the new employee to the employees array
        array_push($employees["body"], $employee );
    }
}

// return the data, encoded as json
// note, you'll see an empty array and a count of zero if your query returns zero rows
// doesn't mean anything is wrong with the code here, just that your query has no results
echo json_encode($employees);