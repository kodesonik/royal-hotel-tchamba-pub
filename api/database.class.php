<?php
class Database
{
    private static $dbName = 'u212932019_db1';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'u212932019_admin';
    private static $dbUserPassword = 'B=9utVF[S^I+';

    private static $cont = null;

    public function __construct()
    {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        if (null === self::$cont) {
            try {
                self::$cont =  new PDO('mysql:host=' . self::$dbHost . '; dbname=' . self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
