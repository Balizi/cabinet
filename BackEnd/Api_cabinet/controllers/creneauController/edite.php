<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once './../../database/db.php';
    require_once './../../model/user.php';

    $database=new Database();
    $db= $database->connect();

    $edit=new User($db);

    // $edit->ref=isset($_GET['ref'])&&isset($_GET['id'])?$_GET['ref']:die();
    $edit->id=isset($_GET['id'])?$_GET['id']:die();

    $res=$edit->edit();

    echo json_encode($res);
