<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
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

    // $chain = substr(generateKey($con),0,8);
    $string =substr(bin2hex(openssl_random_pseudo_bytes(10)),0,8);

    //GET raw posted data
    $data=json_decode(file_get_contents("php://input"));

    $user=new User($db);
    $user->ref=$string;
    $user->nom=$data->nom;
    $user->prenom=$data->prenom;
    $user->datenaissance=$data->datenaissance;
    // $user->signUp();
    if($user->signUp())
    {
        echo json_encode(array('message'=>'user added','id'=>$string,'data'=>$user));
    }else{
        echo json_encode(array('message'=>'Warning'));
    }