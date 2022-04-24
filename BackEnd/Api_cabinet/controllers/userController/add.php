<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    // header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-with");
    
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') 
    {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))        
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))       
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}"); 
    }  
    if($_SERVER["REQUEST_METHOD"]=="OPTIONS") 
        return true;

    require_once './../../database/db.php';
    require_once './../../model/user.php';

    $database=new Database();
    $db= $database->connect();

    $user=new User($db);

    //GET raw posted data
    $data=json_decode(file_get_contents("php://input"));
    if(empty($data->dayy) && empty($data->id_time)) return;
    $user->dayy=$data->dayy;
    $user->ref=$data->ref;
    $user->id_time=$data->id_time;
    if($user->add())
    {
        echo json_encode(array('message'=>'Rendez vous réserver'));
    }