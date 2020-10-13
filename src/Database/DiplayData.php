<?php
namespace Uniword\Database;
/*
 * Connect to the database
 * Get student names
 * Define the query to send to the database
 * We use a prepared statement to execute the query
 * This creates a PDOStatement object
 * Execute the query
 * Return an array containing the query results
 * Allows new SQL statements to execute
*/

class DiplayData{
   function displayStudents()
   {
       $db = new DBConnect();
       $connect = $db->connectDB();
       $query_students = 'SELECT * FROM Student ORDER BY student_id';
       $student_statement = $connect->prepare($query_students);
       $student_statement->execute();
       $students = $student_statement->fetchAll();
       $student_statement->closeCursor();

       echo "<div class = 'Display_Table'>
    <h3>Student List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Phone</th>
            <th>BD</th>
            <th>Sex</th>
            <th>Entered</th>
            <th>Lunch</th>
        </tr>";
       foreach($students as $student)
           {
               echo " <tr>
           
            <td>". $student['student_id']."</td>
            <td>". $student['first_name']."</td>

            <td>".$student['email']."</td>
            <td>".$student['street']."</td>
            <td>". $student['city']."</td>
            <td>". $student['state']."</td>
            <td>".  $student['zip']."</td>
            <td>". $student['phone']."</td>
            <td>".  $student['birth_date']."</td>
            <td>". $student['sex']."</td>
            <td>".  $student['date_entered']."</td>
            <td>". $student['lunch_cost']."</td>
        </tr>";
           }
       echo "</table></div>";
   }
}


