<?php

#This file includes all functions related to crud operations

//Simple Insertion
function insert($table,$cols,$values){
$db=$GLOBALS['DB'];
$insertquery=mysqli_query($db,"insert into $table($cols)values($values)");
if($insertquery){
  return true;
}else {
  return false;
}
}

#update query updates table with given table name and query

function update($table,$query){
$db=$GLOBALS['DB'];
$updatequery=mysqli_query($db,"update $table set $query ");
if($updatequery){
  return true;
}else {
  return false;
}
}

#delete function deletes with given query and table name

function delete($table,$query){
$db=$GLOBALS['DB'];
$deletequery=mysqli_query($db,"delete from $table $query ");
if($deletequery){
  return true;
}else {
  return false;
}
}

#returns data against given query and name

function select($table,$query){
$db=$GLOBALS['DB'];
return mysqli_query($db,"select * from $table $query ");
// if($selectquery){
//   return $selectquery;
// }else {
//   return false;
// }
}

#This function works against general query depending upon need.

function query($query){
  $db=$GLOBALS['DB'];
$query=mysqli_query($db,$query);
if($query){
  return true;
}
else {
  return false;
}
}


 ?>
