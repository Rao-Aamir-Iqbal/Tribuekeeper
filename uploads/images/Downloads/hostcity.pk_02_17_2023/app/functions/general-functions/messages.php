<?php
#This file is containting functions related to all success,error,danger,info and warning messages

#Success & Error Messages
function success($text){
  return "<div class='alert alert-success'>". $text ."</div>";
}
function error($text){
  return "<div class='alert alert-danger'>". $text ."</div>";
}


 ?>
