<?php
   $url=$_SERVER["REQUEST_URI"];
   $url=explode('/',$url);
   $url_loc=$url[2];
   if((isset($_SESSION["email"]) && isset($_SESSION["password"]))&&in_array($url_loc,["login.php","signup.php"]))
   {
     header("Location: ./index.php");
   }
   else if((!isset($_SESSION["email"]) && !isset($_SESSION["password"])) &&!in_array($url_loc,["login.php","signup.php"]))
   {
     header("Location: ./login.php");
   }
?>