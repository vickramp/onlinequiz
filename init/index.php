<?php
require 'dbconfig.php';
$dbobj=connectdb("test");
if(isset($_GET['destroy']))
$sql='drop table users';
else
$sql = "create table if not EXISTS users (id integer primary key auto_increment,name1 varchar(50),password varchar(50),name2 varchar(50),year tinyint,branch tinyint,reg1 varchar(15) unique,reg2 varchar(15) unique,email varchar(50) unique,phone bigint,pos int DEFAULT 0,score int,tme int,tstamp timestamp default CURRENT_TIMESTAMP)";
$dbobj->query($sql);
echo $dbobj->error;
if(isset($_GET['destroy']))
$sql='drop table question';
else
$sql = "create table if not EXISTS question (id integer primary key auto_increment,question text,opt1 text,opt2 text,opt3 text,opt4 text,ans int)";
$dbobj->query($sql);
echo $dbobj->error;
$dbobj->close();
header("location: ../");
exit;
 ?>
