<?php

// ---------------------------------------------------------------------------------
// SAMPLE API - by Casey Blamires (https://www.github.com/clblamires/sample-php-api)
// ---------------------------------------------------------------------------------

// Employees - delete
// removes employees from the table

// setup HTTP headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Controll-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
$employee = new Employee($connection);

// check if an 'id' is present in the URL parameters, and if so, delete only that data
// if an id is not present, $id is set to zero and the delete method should not run
$id = isset($_GET['id']) ? $_GET['id'] : 0 ;

// no id present, return an error message and kill the script
if( $id < 1 ){
    echo json_encode(
        array("message" => "Cannot delete employee", "success" => false)
    );
    die();
}

// an id is present, so we can delete this id
$employee->employee_id = $id;
if( $employee->delete() ){
    echo json_encode(
        array( "message" => "Employee was removed", "success" =>  true )
    );
} else {
    echo json_encode(
        array( "message" => "Unable to remove employee", "success" =>  true )
    );
}