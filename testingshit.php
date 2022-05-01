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
echo "<br/>";

// $assignment_due_date =date_create("2022-03-01");
// $today = date_create("2022-05-01");
// $datedifference = date_diff($today,$assignment_due_date);
// $d= $datedifference->format('%R%d');
// $numbers = preg_replace('/[^0-9]/', '', $d);
// echo $numbers;
// echo "<br/>";

 function getDateDifference2($date)
{
    $newDate = date("Y-m-d", strtotime($date));
    $tdate = time();

    $formattedDate = strtotime(str_replace("/", "-", $newDate));

    $realDateDifference = ceil(($formattedDate -  $tdate) / 86400);
    // echo $realDateDifference;
    //  $dateDifference = date('Y', $tdate) - date('Y', $formattedDate);

    return $realDateDifference;
}

echo getDateDifference2("2022-03-01");
// $days = explode("+",$d);
// echo $days[1];
