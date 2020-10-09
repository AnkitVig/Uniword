<?php
// ==========================================================================
// Project: UniWord
// ==========================================================================

/**
 * Class to for connecting to Database.
 */
namespace Uniword\Database;
use PDO;

DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD','MyNewPass');
class DBConnect
{   const DB_USER = 'root';
    const DB_PASSWORD='MyNewPass';
    function connectDB(){
        $dsn = 'mysql:host=localhost:3306;dbname=Students';
        try{

            $db = new PDO($dsn, DB_USER, DB_PASSWORD);
        } catch (PDOException $e)
        {
            $err_msg = $e->getMessage();
            return $err_msg;
        }


        return $db;
    }

}


?>