<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Day 2</title>
</head>
<body>
<form action="exercise3.php" method ="POST">
First Number: <input type="number"  name="number1"/>
Second Number: <input type ="number" name="number2"/>
<button type="submit" name="calculate">Calculate</button>
</form>
<?php
if( isset($_POST['calculate']))
{
    $num1 = $_POST['number1'];
    $num2 = $_POST['number2'];
    function divide($num1,$num2) {  
        $result = $num1 / $num2; 
        echo $num1 ." devided by " . $num2 . " is " . $result . ".";
};
divide($num1,$num2);
}

?> 
</body>
</html>