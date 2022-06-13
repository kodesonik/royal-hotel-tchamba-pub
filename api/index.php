<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

require './database.class.php';
require './upload.class.php';

if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
    $id =  (int)$_POST['id'];
    $delete = $_POST['delete'];
    if ($delete) {
    $response = Upload::delete($id);
    echo json_encode($response);
   }
    else if(isset($_FILES['file']['name'])){
      /* Getting file name */
      $filename = $_FILES['file']['name'];
  /*    var_dump($_FILES['data'][1]);
      exit;*/
      /* Location */
      $lastDot = strrpos($filename, '.');
      $location = "uploads/img-".time().".".substr($filename, $lastDot + 1); 
      $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
      $imageFileType = strtolower($imageFileType);
   
      /* Valid extensions */
      $valid_extensions = array("jpg","jpeg","png");
   
      $status  = "error";
      $message = "Une errreur s'ext produite lors upload, veuillez reessayer ".$location;
      $response = array(
         'status'  => $status,
         'message' => $message
     );
     
      /* Check file extension */
      if(in_array(strtolower($imageFileType), $valid_extensions)) {
         /* Upload file */
         
         if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            $response = Upload::register($id, $location);
         } else {
            $response["message"] = "erreur deplacement du fichier";
         }
      } else {
           $response["message"] = "erreur format";
      }
      echo json_encode($response);
      exit;
   }
   
} else if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') == 0) {
   $response = Upload::readAll();
   echo json_encode($response);
} else {
   throw new Exception('Request method must be POST or GET!');
}

