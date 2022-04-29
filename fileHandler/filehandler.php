<?php
class FileHandler
{   private $status =false;
    public $thecommonfile;
    public $thefile;
    public $unique_name_generated;
    public function filedetails($thefile, $foldername, $size, $type)
    {

        $file = $thefile;
        $filename = $file["name"];
        $filetype = $file["type"];
        $filesize = $file["size"];
        $filetemp = $file["tmp_name"];

        $this->unique_name_generated = "{$foldername}/" . uniqid() . $filename;
        $filefullname = explode(".", $filename);
        $format = strtolower(end($filefullname));

        $acceptedtype = array("{$type}");
        $acceptedsize = "{$size}";

        if (in_array($format, $acceptedtype) === false) {
            $errors[] = "not the expected file format it should be a {$type} file .";
        }

        if ($filesize > $acceptedsize) {
            $errors[] = "File size must be excately {$size} MB";
        }

        if (empty($errors) == true) {
            move_uploaded_file($filetemp, $this->unique_name_generated);
            $this->status =true;
           
        } else {
            print_r($errors);
        }
        return $this->status;
    }
    public function getFilename()
    {
        return $this->unique_name_generated;
    }
}


// $charLength = 25;
// if (
//     isset($_POST["SampleName"]) 
//     && isset($_POST["SamplePrice"]) 
//     && isset($_POST["SampleDescription"])

// ) {


//     if (isset($_FILES["SampleFile"])) {

//         if (
//             $_FILES["SampleFile"]["type"] == "application/x-zip-compressed" && $_FILES["SampleAudio"]["type"] == "audio/mpeg" && $_FILES["SampleImage"]["type"] == "image/jpeg"
//         ) {
//             require "../DB/DB.php";

//             $availabletypes;

//             $sname = $_POST["SampleName"];
//             $sprice = $_POST["SamplePrice"];
//             $subSampletype = $_POST["SampleSubMelody"];
//             $sampledescription = $_POST["SampleDescription"];
//             echo $subSampletype;
//             $date = date("Y-m-d h:i:s");



//             if (isset($_FILES["SampleFile"])) {
//                 $fileHandlerforzip = new FileHandler();
//                 $fileHandlerforzip->filedetails($_FILES["SampleFile"], "samples", "50000000", "zip");
//                 $zippathname = $fileHandlerforzip->getFilename();
//             }
//         } else {

//             echo "Not the exact file type ";
//         }
//     }
// } else {
// }
