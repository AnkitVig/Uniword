<?php

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

require_once __DIR__ . '/../vendor/autoload.php';
$db = new namespace\Uniword\Database\DBConnect();
$connect = $db->connectDB();
$query_students = 'SELECT * FROM Student ORDER BY student_id';
$student_statement = $connect->prepare($query_students);
$student_statement->execute();
$students = $student_statement->fetchAll();
$student_statement->closeCursor();
?>
<div class = "Display_Table">
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
        </tr>
        <!-- Get an array from the DB query and cycle
        through each row of data -->
        <?php foreach($students as $student) : ?>
        <tr>
            <!-- Print out individual column data -->
            <td><?php echo $student['student_id']; ?></td>
            <td><?php echo $student['first_name']; ?></td>
            <!--                     . ' ' . $student['last_name']; -->
            <td><?php echo $student['email']; ?></td>
            <td><?php echo $student['street']; ?></td>
            <td><?php echo $student['city']; ?></td>
            <td><?php echo $student['state']; ?></td>
            <td><?php echo $student['zip']; ?></td>
            <td><?php echo $student['phone']; ?></td>
            <td><?php echo $student['birth_date']; ?></td>
            <td><?php echo $student['sex']; ?></td>
            <td><?php echo $student['date_entered']; ?></td>
            <td><?php echo $student['lunch_cost']; ?></td>
        </tr>

        <!-- Mark the end of the foreach loop -->
        <?php endforeach; ?>
    </table>




</div>
