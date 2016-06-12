<?php

$location ="upload";


function upload($name, $loc){
  $allowedExts = array("txt");
  $extension = explode(".", $_FILES[$name]["name"]);
  $file_ext = end($extension);

  if (($_FILES[$name]["size"] < 100000) // see on 100kb
   && in_array($file_ext, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
    if ($_FILES[$name]["error"] > 0) {
      return "";
    } else {
      // vigu ei ole
      if (file_exists($loc."/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
        return $_FILES[$name]["name"];
      } else {
        // kõik ok, aseta pilt
        move_uploaded_file($_FILES[$name]["tmp_name"], $loc."/" . $_FILES[$name]["name"]);
        return $_FILES[$name]["name"];
      }
    }
  } 
}

function filecount() {
    $directory = "/upload/";
    $filecount = 0;
    $files = glob($directory . "*");
    if ($files){
        $filecount = count($files);
    }
    return "There were $filecount files";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>eksam_mmatson</title>
    <style type="text/css">
    </style>
</head>
<body>
      
      <form action = "" method = "POST" enctype = "multipart/form-data">
         Vali fail: <input type = "file" name = "fail" />
         <input type = "submit"/>
      </form>
<?php
if(($_SERVER['REQUEST_METHOD'] == 'POST') &&  isset($_FILES['fail'])) {
    $uploadfail = upload("fail",$location);
    if ($uploadfail != "") {
        echo "<p>Fail ". $uploadfail. " edukalt &uuml;les laetud!</p>";
    } else {
        echo "<p>Faili &uuml;leslaadimine ebaonnestus</p>";
    }
}

echo "<p>".filecount()."</p>";
?>

</body>
</html>
