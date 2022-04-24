<?php


$con=mysqli_connect("localhost","root","","cabinet");

function checkKeys($con,$randStr)
{
    $sql="SELECT * FROM user";
    $res=mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($res))
    {
        if($row['ref'] == $randStr)
        {
            $keyExist=true;
            break;
        }
        else{
            $keyExist=false;
        }
    }
    return $keyExist;
}

function generateKey($con)
{
    $keyLength=8;
    $str=strtoupper("lredmip861s4u0641972m");
    $randStr=str_shuffle($str);
    $checkKey=checkKeys($con,$randStr);
    while($checkKey == true)
    {
        $randStr=str_shuffle($str);
        $checkKey=checkKeys($con,$randstr);
    }
    return $randStr;
}
