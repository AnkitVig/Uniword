<?php
//Connect to the database
require_once __DIR__ . '/../vendor/autoload.php';
//require('../src/Database/DBConnect.php');

$db = new namespace\Uniword\Database\DBConnect();
$connect = $db->connectDB();
//Get student names
//Define the query to send to the database
$query_students = 'SELECT * FROM Student ORDER BY student_id';
//We use a prepared statement to execute the query
//This creates a PDOStatement object
$student_statement = $connect->prepare($query_students);
# Execute the query
$student_statement->execute();
# Return an array containing the query results
$students = $student_statement->fetchAll();
# Allows new SQL statements to execute
$student_statement->closeCursor();
?>
<!DOCTYPE html>
<html>
   <head>
     <title>Load Documents in Browser using PHPSpreadsheet and PHPWord</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <script src="index.js"></script>
   </head>
   <body>
     <div class="container">
      <br />
      <h3 align="center">Load Excel and Word Document in Browser using PHPSpreadsheet and Php Word</h3>
      <br />
      <div class="table-responsive">
          <!-- Excel Form Loading Data -->
      <span id="message"></span>
         <form method="POST" id="load_excel_form" enctype="multipart/form-data">
           <table class="table">
             <tr>
               <td width="25%" align="right">Select File</td>
               <td width="50%"><input type="file" id ="filename" name="filename" /></td>
               <td method = "POST" width="25%"><input type="submit" name="load" id="btn"   class="btn btn-primary" /></td>
             </tr>
           </table>
         </form>
      </div>
               <div id="excel_area"></div>
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
             <h3>Insert Student</h3>
             <form action="router.php" method="post"
                   id="add_student_form">
                 <label>First Name : </label>
                 <input type="text" name="first_name"><br>
                 <label>Email : </label>
                 <input type="text" name="email"><br>
                 <label>Street : </label>
                 <input type="text" name="street"><br>
                 <label>City : </label>
                 <input type="text" name="city"><br>
                 <label>State : </label>
                 <input type="text" name="state"><br>
                 <label>Zip Code : </label>
                 <input type="text" name="zip"><br>
                 <label>Phone : </label>
                 <input type="text" name="phone"><br>
                 <label>Birth Date : </label>
                 <input type="text" name="birthdate"><br>
                 <label>Sex : </label>
                 <input type="text" name="sex"><br>
                 <label>Lunch Cost : </label>
                 <input type="text" name="lunch"><br>
                 <input method = "post" name="Add" type="submit" value="Add Student"><br>
             </form>

      <br />

          <!-- <button class="btn btn-primary type="button" onclick="create()"> "Download"</button> -->

</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->

</body>
</html>







