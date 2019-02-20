<?php

// ---------------------------------------------------------------------------------
// SAMPLE API - by Casey Blamires (https://www.github.com/clblamires/sample-php-api)
// ---------------------------------------------------------------------------------

// Employees - create
// adds new employees to the table

// setup HTTP headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Controll-Allow-Methods: POST");
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

// create employee
$employee = new Employee($connection);

// decode json data from POST request
$data = json_decode( file_get_contents("php://input"));
if( !$data ){
    // on error, return error
    echo json_encode(
        array("message" => "Cannot create products", "success" => false )
    );
    die(); // mwahahahahah....
}

// set class properties
$employee->firstname = $data->firstname;
$employee->lastname = $data->lastname;
$employee->password = md5($data->password);
$employee->archive = 0;

// attempt to create the new record
if( $employee->create() ){
    // on success, send success message
    echo json_encode(
        array( "message" => "Employee was created", "success" =>  true )
    );
} else {
    // on failure, send failure message
    echo json_encode(
        array( "message" => "Unable to create employee", "success" => false )
    );
}
