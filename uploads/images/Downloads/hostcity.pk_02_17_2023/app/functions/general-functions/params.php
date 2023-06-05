<?php

#Accepting Parameters & Defining Pages
$url=explode('/',$_SERVER['REQUEST_URI']);

    if(!empty($url[1])){

        $text=explode('?',$url[1]);

        if(isset($text[1])){
        define('page',$text[0]);
        }
        else{
        define('page',$url[1]);
        }
    }
    else{
      define('page',"");
    }


    if(!empty($url[2])){

        $text=explode('?',$url[2]);
        if(isset($text[1])){
        define('param1',$text[0]);
        }
        else{
        define('param1',$url[2]);
        }

    }
    else{
      define('param1',"");
    }


     if(!empty($url[3])){

        $text=explode('?',$url[3]);
        if(isset($text[1])){
        define('param2',$text[0]);
        }
        else{
        define('param2',$url[3]);
        }

    }
    else{
      define('param2',"");
    }



     if(!empty($url[4])){

        $text=explode('?',$url[4]);
        if(isset($text[1])){
        define('param3',$text[0]);
        }
        else{
        define('param3',$url[4]);
        }

    }
    else{
      define('param3',"");
    }




 if(!empty($url[5])){

        $text=explode('?',$url[5]);
        if(isset($text[1])){
        define('param4',$text[0]);
        }
        else{
        define('param4',$url[5]);
        }

    }
    else{
      define('param4',"");
    }


 if(!empty($url[6])){

        $text=explode('?',$url[6]);
        if(isset($text[1])){
        define('param5',$text[0]);
        }
        else{
        define('param5',$url[6]);
        }

    }
    else{
      define('param5',"");
    }


 ?>
