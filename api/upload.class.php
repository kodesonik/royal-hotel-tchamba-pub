<?php
class Upload
{
    private static $id;
    private static $image;
    private static $datetime = null;

    private static $valid = true;

    public function __construct()
    {
        die('Init function is not allowed');
    }

    public static function register($id, $image)
    {
        $status  = "error";
        $message = "Missing id ".$id." and image ".$image;
        if ($id && $image) {
            self::$id    = $id;
            self::$image    = $image;
            self::$datetime = date('Y-m-d H:i:s');

            if (empty(self::$id)) {
                $status  = "error";
                $message = "The id field must not be blank";
                self::$valid = false;
            } else if (empty(self::$image)) {
                $status  = "error";
                $message = "The image address field must not be blank";
                self::$valid = false;
            }

            if (self::$valid) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE pubs SET image=:image, createdAt=:datetime WHERE id=:id";
                $q = $pdo->prepare($sql);

                $q->execute(
                    array(':id' => self::$id, ':image' => self::$image, ':datetime' => self::$datetime)
                );

                if ($q) {
                    $status  = "success";
                    $message = "Pub ajouté avec success!";
                } else {
                    $message = "Une errreur s'ext produite, veuillez reessayer";
                }
            }

          
            Database::disconnect();
        }
          $data = array(
                'status'  => $status,
                'message' => $message
            );
        return $data;

    }

    public static function readAll()
    {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM pubs";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $data;
    }

    public static function delete($id) {
        $status  = "error";
        $message = "Missing id ".$id;
        if ($id) {
            self::$id    = $id;
            self::$image    = null;
            self::$datetime = date('Y-m-d H:i:s');

            if (empty(self::$id)) {
                $status  = "error";
                $message = "The id field must not be blank";
                self::$valid = false;
            } 

            if (self::$valid) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE pubs SET image=:image, createdAt=:datetime WHERE id=:id";
                $q = $pdo->prepare($sql);

                $q->execute(
                    array(':id' => self::$id, ':image' => self::$image, ':datetime' => self::$datetime)
                );

                if ($q) {
                    $status  = "success";
                    $message = "Pub supprimé avec success!";
                } else {
                    $message = "Une errreur s'ext produite, veuillez reessayer";
                }
            }

          
            Database::disconnect();
        }
          $data = array(
                'status'  => $status,
                'message' => $message
            );
        return $data;
    }
}
