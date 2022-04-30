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
$passwordMatchStatus = password_verify("fad4a917869b276e85ce38d9ae736b6d", "$2y$10$ymBrIILI5t1.CshFsGb52OGAnIK20arR0UQySfbJkYfaZjHKI4Ssa");
if($passwordMatchStatus){
    echo "No problem";
}else{
    echo "Nope";
}