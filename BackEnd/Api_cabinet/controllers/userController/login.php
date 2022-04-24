<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
// header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-with");

require_once './../../database/db.php';
require_once './../../model/user.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

//GET raw posted data
$ref = $_GET['ref'];

$user->ref = $ref;

if ($user->login()) {
    echo json_encode($user->login());
} else {
    echo json_encode(array('message' => 'not found'));
}
