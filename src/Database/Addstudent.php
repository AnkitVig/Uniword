<?php
// ==========================================================================
// Project: UniWord
// ==========================================================================

/**
 * Class is used to add Data to the database
 * Define the query to send to the database
 * We use a prepared statement to execute the query
 * Execute the query
 * Return an array containing the query results
 * Allows new SQL statements to execute
 */



namespace Uniword\Database;

class Addstudent
{

    function generateQuery(){
        try {
            $query_students = "INSERT into Students.Student (first_name,email,street,city,state,zip,phone,birth_date,sex,date_entered,lunch_cost) VALUES  ('" . $_POST["first_name"] . "','" . $_POST["email"] . "','" . $_POST["street"] . "',
        '" . $_POST["city"] . "','" . $_POST["state"] . "', '" . $_POST["zip"] . "', " . $_POST["phone"] . ",  '" . $_POST["birthdate"] . "',
        '" . $_POST["sex"] . "',  now(), " . $_POST["lunch"] . ")";

            $db = new DBConnect();
            $connect = $db->connectDB();
            $statement = $connect->prepare($query_students);
            $statement->execute();
            $statement->closeCursor();
            $message = '<div class="oktMsg">Data is succesfully Entered</div>';
            echo $message;


        }
        catch (Exception $exception){
            $message = '<div class="alertMsg">Wrong Entry</div>';
            echo $message;
        }

    }
}


?>