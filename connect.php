<?php
$localhost='localhost';
$username='root';
$password='';
$dbname='october_db';

$connect = new mysqli($localhost, $username, $password, $dbname);

if($connect->connect_error){
    echo 'not connected'.$connect->connect_error;
}
else{
    echo 'connected successfully';
}