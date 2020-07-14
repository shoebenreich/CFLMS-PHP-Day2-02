<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Day 02</title>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "exercise4";

        $conn = new mysqli($servername,$username,$password,$db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        };
        
        $sql = $conn->query("CREATE DATABASE exercise4");

        $sql_insert = $conn->query("CREATE TABLE Users (user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(20) NOT NULL,
            lastname VARCHAR(20) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP)");

    ?>
<h1>Create new User:</h1>
<form action="exercise4.php" method ="post">
   <p>
       <label  for="firstName">First Name:</label>
       <input type="text" name= "firstname" id="firstName">
   </p >
   <p>
       <label for ="lastName">Last Name:</label>
       <input  type="text" name="lastname"  id="lastName">
   </p>
   <p>
       <label for= "emailAddress">Email Address:</label>
       <input  type="text" name= "email" id="emailAddress">
   </p>
   <input type= "submit" value="Submit" name="add">
</form>
<?php

if (isset($_POST['add'])){
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];

    $sql_insert = $conn->query("INSERT INTO Users(firstname, lastname, email) VALUES ('$firstName','$lastName','$email')");
    echo "Data insert sucessfull.";
    header("location: exercise4.php");
};

?>
<table class="table">
    <thead>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql_out = $conn->query("SELECT * FROM Users");
        while ($row = $sql_out->fetch_assoc()) {
            $userid = $row["user_id"];
            $fname = $row["firstname"];
            $lname = $row["lastname"];
            $mail = $row["email"];

            echo "<tr>
            <td>$userid</td>
            <td>$fname</td>
            <td>$lname</td>
            <td>$mail</td>
            </tr>";
    
        };
        ?>
    </tbody>
</table>
<h1>Update User:</h1>
<form action="exercise4.php" method ="post">
    <p>
       <label  for="userID">User ID:</label>
       <input type="text" name= "userID">
   </p>
   <p>
       <label  for="u_f_name">First Name:</label>
       <input type="text" name= "u_f_name">
   </p>
   <p>
       <label for ="u_l_name">Last Name:</label>
       <input  type="text" name="u_l_name">
   </p>
   <p>
       <label for= "u_email">Email Address:</label>
       <input  type="text" name= "u_email">
   </p>
   <input type= "submit" value="Submit" name = "update">
</form>
<?php
if (isset($_POST['update'])){
    $u_userid = $_POST["userID"];
    $u_fName = $_POST["u_f_name"];
    $u_lName = $_POST["u_l_name"];
    $u_mail = $_POST["u_email"];

    $sql_check = $conn->query("SELECT user_id FROM Users WHERE user_id = $u_userid");

    if ($sql_check) {
        if($u_fName != "" and $u_lName != "" and $u_mail != "") {
        $sql_insert = $conn->query("UPDATE Users SET firstname='$u_fName', lastname='$u_lName', email='$u_mail' WHERE user_id=$u_userid");   
         echo "Data update sucessfull.";
        }
        elseif ($u_fName = " "|| $u_lName = " " || $u_mail = " ") {
            echo "Data incomplete. Please fill everything in.";
        };
    }
    else echo "User does not exist."; 
};

?>

</body>
</html>