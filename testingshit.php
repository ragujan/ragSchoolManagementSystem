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
    echo "Yess";
} else {
    echo "Nope";
}
