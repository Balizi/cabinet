<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-with");
  

require_once './../../database/db.php';
require_once './../../model/creneau.php';

$database=new Database();
$db= $database->connect();

$creneau=new Rendezvous($db);

// $data=json_decode(file_get_contents("php://input"));

$creneau->id=isset($_GET['id'])?$_GET['id']:die();

if($creneau->Delete())
{
    echo json_encode(
        array('message'=>'creneau Delete')
    );
}
