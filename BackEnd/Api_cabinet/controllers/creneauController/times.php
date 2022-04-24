<?php


    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    // header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-with");

    require_once './../../database/db.php';
    require_once './../../model/creneau.php';

    $database=new Database();
    $db= $database->connect();

    $rendez=new Rendezvous($db);

    $AllTimes=$rendez->All();

    $TimeCheck=$rendez->CheckDate($_GET['day']);

    // echo json_encode($AllTimes);
    
    $new=[];
    foreach($AllTimes as $time)
    {
        $find=false;
        foreach($TimeCheck as $check)
        {
            if($time['id_time']==$check['id_time']) $find=true;
        }
        if(!$find) $new[]=$time;
    }
    echo json_encode($new);