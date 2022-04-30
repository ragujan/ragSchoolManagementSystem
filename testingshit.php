<?php


$checkPath = "../../lessonnotes/626b7bfb4912alessonnotesPDF.pdf";
function pathstringcheck($str)
{

    $checkfor = "/^(\.\.\/\.\.\/lessonnotes\/)/";
    $state = false;
    if (empty($str)) {

        $state = false;
    } else if (!preg_match($checkfor, $str)) {
        $state = false;
    } else {
        $state = true;
    }
    return $state;
}

$pathstringcheck = pathstringcheck($checkPath);
if ($pathstringcheck ) {
   
} else {
  
}
$passwordMatchStatus = password_verify("f0be46b3ad1dc2d22abd0233f3c88f98", "$2y$10$8Gx9THOlJoomPXyIU.fJEuPhGeoeO/sqDdE9IorwcJgOadJxHfBju");
if($passwordMatchStatus){
    echo "No problem";
}else{
    echo "Nope";
}