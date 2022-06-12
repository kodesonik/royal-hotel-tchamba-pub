<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

require './database.class.php';
require './upload.class.php';

if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
   if(isset($_FILES['file']['name'])){
      /* Getting file name */
      $filename = $_FILES['file']['name'];
      $id =  intval($_FILES['id']);
   
      /* Location */
      $location = "uploads/".$filename;
      $lastDot = strrpos($filename, '.');
      $location = "img-$date" . substr($filename, $lastDot + 1); 
      $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
      $imageFileType = strtolower($imageFileType);
   
      /* Valid extensions */
      $valid_extensions = array("jpg","jpeg","png");
   
      $status  = "error";
      $message = "Une errreur s'ext produite, veuillez reessayer";
      $response = array(
         'status'  => $status,
         'message' => $message
     );
      /* Check file extension */
      if(in_array(strtolower($imageFileType), $valid_extensions)) {
         /* Upload file */
         if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            $response = Upload::register($id, $location);
         }
      }
      echo json_encode($response);
      exit;
   }
} else if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') == 0) {
   $response = Upload::readAll();
   echo json_encode($response);
} else if (strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE') == 0) {
   $response = Upload::delete(isset($_POST['id']));
   echo json_encode($response);
} else {
   throw new Exception('Request method must be POST or GET!');
}

