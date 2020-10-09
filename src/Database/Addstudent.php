<?php
// ==========================================================================
// Project: UniWord
// ==========================================================================

/**
 * Class is used to add Data to the database.
 */


namespace Uniword\Database;
class Addstudent
{

function generateQuery()
{
    $query_students = "INSERT into Student  VALUES  ('" . $_POST["first_name"] . "','" . $_POST["email"] . "','" . $_POST["street"] . "',
'" . $_POST["city"] . "','" . $_POST["state"] . "', '" . $_POST["zip"] . "', " . $_POST["phone"] . ",  '" . $_POST["birthdate"] . "',
'" . $_POST["sex"] . "',  now(), " . $_POST["lunch"] . ")";

    $dbg = new namespace\DBConnect();
    $statement = $dbg.connectDB()->prepare($query_students);
# Execute the query
    $statement->execute();
# Allows new SQL statements to execute
    $statement->closeCursor();
}
}





?>