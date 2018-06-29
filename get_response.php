<?php
require_once("functions.php");
if((isset($_POST['meal_name'])&& $_POST['meal_name'] !='') && (isset($_POST['url'])&& $_POST['url'] !=''))
{
 require_once("index.php");

$yourName = $conn->real_escape_string($_POST['meal_name']);
$yourEmail = $conn->real_escape_string($_POST['url']);

$sql="INSERT INTO contact_form_info (mealname, url) VALUES ('".$meal_name."','".$url."')";


if(!$result = $conn->query($sql)){
die('There was an error running the query [' . $conn->error . ']');
}
else
{
echo "Thank you! We will contact you soon";
}
}
else
{
echo "Please fill Name and Email";
}
?>
