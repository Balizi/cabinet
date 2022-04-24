<?php


    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once './../../database/db.php';
    require_once './../../model/user.php';

    $database=new Database();
    $db= $database->connect();

    $user=new User($db);

    $user->ref=isset($_GET['ref'])?$_GET['ref']:die();

    $res=$user->getAll();

    echo json_encode($res);