<html>

<table>

<tr>

<td>Meal</td>
<td>Url</td>
</tr>
<?php

// Enter username and password
$username = 'root';
$password = 'root';

// Create database connection using PHP Data Object (PDO)
$db = new PDO("mysql:host=localhost;dbname=meal_plannr", $username, $password);

// Identify name of table within database
$table = 'users';

// Create the query - here we grab everything from the table
$stmt = $db->query('SELECT * from '.$table);

// Close connection to database
$db = NULL;

while($rows = $stmt->fetch()){
echo "<tr><td>". $rows['username'] . "</td><td><a class='btn' href='" . $rows['password'] . "' target='_blank'>Link</a></td></tr>";
};
?>
</table>
</html>
